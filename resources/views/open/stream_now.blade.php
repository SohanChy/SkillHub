@extends('open.layouts.base')

@section('content')



<section class="make-center mui--text-center">
    <div class="make-center mui--text-center">
        <div>
            <h2>{{$stream->title}}</h2>
            <p>{{$stream->description}}</p>
            <h3 id="countDown"></h3>

            @if(!$subscribedStatus)
                <a href="{{url('checkout-stream/'.$stream->id)}}">
                <button class="mui-btn mui-btn--danger">Subscribe to this Broadcast</button>
                </a>
            @endif

        {{--<input type="hidden" id="broadcast-id" value="sohan123" autocorrect=off autocapitalize=off size=20>--}}
        {{--<button id="open-or-join" class="mui-btn mui-btn--danger">Open or Join Broadcast</button>--}}
        </div>


        {{--<div id="room-urls" style="text-align: center;display: none;background: #F1EDED;margin: 15px -10px;border: 1px solid rgb(189, 189, 189);border-left: 0;border-right: 0;"></div>--}}

        @if($subscribedStatus)
        <div class="make-center" id="broadcast-viewers-counter">
        </div>

        <video id="video-preview" controls loop></video>
        @endif

    </div>

    <div class="mui-row" >
        <div class="mui-col-md-3"></div>
        <div class="mui-col-md-6">
            <div class="mui-col-md-12">
                @component("open.comments.main",[
                "comments"=>$comments,
                "comment"=>$comment,
                "type"=>"livestream",
                "parent_id"=>$stream->id,
                "user"=>\Illuminate\Support\Facades\Auth::user()])
                @endcomponent
            </div>
        </div>
    </div>




</section>


<script src="https://rtcmulticonnection.herokuapp.com/dist/RTCMultiConnection.min.js"></script>
<script src="https://rtcmulticonnection.herokuapp.com/socket.io/socket.io.js"></script>
<!-- <script src="https://cdn.webrtc-experiment.com/RecordRTC.js"></script> -->

@if($subscribedStatus)
<script>
    // recording is disabled because it is resulting for browser-crash
    // if you enable below line, please also uncomment above "RecordRTC.js"
    var enableRecordings = false;

    var connection = new RTCMultiConnection();

    // its mandatory in v3
    connection.enableScalableBroadcast = true;

    // each relaying-user should serve only 1 users
    connection.maxRelayLimitPerUser = 1;

    // we don't need to keep room-opened
    // scalable-broadcast.js will handle stuff itself.
    connection.autoCloseEntireSession = true;

    // by default, socket.io server is assumed to be deployed on your own URL
    connection.socketURL = '/';

    // comment-out below line if you do not have your own socket.io server
    connection.socketURL = 'https://rtcmulticonnection.herokuapp.com:443/';

    connection.socketMessageEvent = 'scalable-media-broadcast-demo';

    // document.getElementById('broadcast-id').value = connection.userid;

    // user need to connect server, so that others can reach him.
    connection.connectSocket(function(socket) {
        socket.on('logs', function(log) {
            var loggy = log.replace(/</g, '----').replace(/>/g, '___').replace(/----/g, '(<span style="color:red;">').replace(/___/g, '</span>)');
            console.log(loggy);
        });

        // this event is emitted when a broadcast is already created.
        socket.on('join-broadcaster', function(hintsToJoinBroadcast) {
            console.log('join-broadcaster', hintsToJoinBroadcast);

            connection.session = hintsToJoinBroadcast.typeOfStreams;
            connection.sdpConstraints.mandatory = {
                OfferToReceiveVideo: !!connection.session.video,
                OfferToReceiveAudio: !!connection.session.audio
            };
            connection.broadcastId = hintsToJoinBroadcast.broadcastId;
            connection.join(hintsToJoinBroadcast.userid);
        });

        socket.on('rejoin-broadcast', function(broadcastId) {
            console.log('rejoin-broadcast', broadcastId);

            connection.attachStreams = [];
            socket.emit('check-broadcast-presence', broadcastId, function(isBroadcastExists) {
                if (!isBroadcastExists) {
                    // the first person (i.e. real-broadcaster) MUST set his user-id
                    connection.userid = broadcastId;
                }

                socket.emit('join-broadcast', {
                    broadcastId: broadcastId,
                    userid: connection.userid,
                    typeOfStreams: connection.session
                });
            });
        });

        socket.on('broadcast-stopped', function(broadcastId) {
            // alert('Broadcast has been stopped.');
            // location.reload();
            console.error('broadcast-stopped', broadcastId);
            alert('This broadcast has been stopped.');
        });

        // this event is emitted when a broadcast is absent.
        socket.on('start-broadcasting', function(typeOfStreams) {
            console.log('start-broadcasting', typeOfStreams);

            // host i.e. sender should always use this!
            connection.sdpConstraints.mandatory = {
                OfferToReceiveVideo: false,
                OfferToReceiveAudio: false
            };
            connection.session = typeOfStreams;

            // "open" method here will capture media-stream
            // we can skip this function always; it is totally optional here.
            // we can use "connection.getUserMediaHandler" instead
            connection.open(connection.userid, function() {
                showRoomURL(connection.sessionid);
            });
        });
    });

    window.onbeforeunload = function() {
        // Firefox is ugly.
        document.getElementById('open-or-join').disabled = false;
    };

    var videoPreview = document.getElementById('video-preview');

    connection.onstream = function(event) {
        if (connection.isInitiator && event.type !== 'local') {
            return;
        }

        connection.isUpperUserLeft = false;
        videoPreview.srcObject = event.stream;
        videoPreview.play();

        videoPreview.userid = event.userid;

        if (event.type === 'local') {
            videoPreview.muted = true;
        }

        if (connection.isInitiator == false && event.type === 'remote') {
            // he is merely relaying the media
            connection.dontCaptureUserMedia = true;
            connection.attachStreams = [event.stream];
            connection.sdpConstraints.mandatory = {
                OfferToReceiveAudio: false,
                OfferToReceiveVideo: false
            };

            var socket = connection.getSocket();
            socket.emit('can-relay-broadcast');

            if (connection.DetectRTC.browser.name === 'Chrome') {
                connection.getAllParticipants().forEach(function(p) {
                    if (p + '' != event.userid + '') {
                        var peer = connection.peers[p].peer;
                        peer.getLocalStreams().forEach(function(localStream) {
                            peer.removeStream(localStream);
                        });
                        event.stream.getTracks().forEach(function(track) {
                            peer.addTrack(track, event.stream);
                        });
                        connection.dontAttachStream = true;
                        connection.renegotiate(p);
                        connection.dontAttachStream = false;
                    }
                });
            }

            if (connection.DetectRTC.browser.name === 'Firefox') {
                // Firefox is NOT supporting removeStream method
                // that's why using alternative hack.
                // NOTE: Firefox seems unable to replace-tracks of the remote-media-stream
                // need to ask all deeper nodes to rejoin
                connection.getAllParticipants().forEach(function(p) {
                    if (p + '' != event.userid + '') {
                        connection.replaceTrack(event.stream, p);
                    }
                });
            }

            // Firefox seems UN_ABLE to record remote MediaStream
            // WebAudio solution merely records audio
            // so recording is skipped for Firefox.
            if (connection.DetectRTC.browser.name === 'Chrome') {
                repeatedlyRecordStream(event.stream);
            }
        }
    };

    // ask node.js server to look for a broadcast
    // if broadcast is available, simply join it. i.e. "join-broadcaster" event should be emitted.
    // if broadcast is absent, simply create it. i.e. "start-broadcasting" event should be fired.
    function startStreamNow() {
        var broadcastId = "{{substr($stream->title, 0, 5)}}{{$stream->id}}";

/*        if (broadcastId.replace(/^\s+|\s+$/g, '').length <= 0) {
            alert('Please enter broadcast-id');
            document.getElementById('broadcast-id').focus();
            return;
        }*/

        // document.getElementById('open-or-join').disabled = true;

        connection.session = {
            audio: true,
            video: true,
            oneway: true
        };

        var socket = connection.getSocket();

        socket.emit('check-broadcast-presence', broadcastId, function(isBroadcastExists) {
            if (!isBroadcastExists) {
                console.log("IT IS: " + isBroadcastExists);
                @if(!$isTeacher)
                    document.getElementById("countDown").innerHTML = "Teacher has not started broadcast yet...<br/> Please Try again in a moment!";
                    document.getElementById("video-preview").style.display = "none";
                    return;
                @endif
                // the first person (i.e. real-broadcaster) MUST set his user-id
                connection.userid = broadcastId;
            }

            console.log('check-broadcast-presence', broadcastId, isBroadcastExists);

            socket.emit('join-broadcast', {
                broadcastId: broadcastId,
                userid: connection.userid,
                typeOfStreams: connection.session
            });
        });
    };

    connection.onstreamended = function() {};

    connection.onleave = function(event) {
        if (event.userid !== videoPreview.userid) return;

        var socket = connection.getSocket();
        socket.emit('can-not-relay-broadcast');

        connection.isUpperUserLeft = true;

        if (allRecordedBlobs.length) {
            // playing lats recorded blob
            var lastBlob = allRecordedBlobs[allRecordedBlobs.length - 1];
            videoPreview.src = URL.createObjectURL(lastBlob);
            videoPreview.play();
            allRecordedBlobs = [];
        } else if (connection.currentRecorder) {
            var recorder = connection.currentRecorder;
            connection.currentRecorder = null;
            recorder.stopRecording(function() {
                if (!connection.isUpperUserLeft) return;

                videoPreview.src = URL.createObjectURL(recorder.getBlob());
                videoPreview.play();
            });
        }

        if (connection.currentRecorder) {
            connection.currentRecorder.stopRecording();
            connection.currentRecorder = null;
        }
    };

    var allRecordedBlobs = [];

    function repeatedlyRecordStream(stream) {
        if (!enableRecordings) {
            return;
        }

        connection.currentRecorder = RecordRTC(stream, {
            type: 'video'
        });

        connection.currentRecorder.startRecording();

        setTimeout(function() {
            if (connection.isUpperUserLeft || !connection.currentRecorder) {
                return;
            }

            connection.currentRecorder.stopRecording(function() {
                allRecordedBlobs.push(connection.currentRecorder.getBlob());

                if (connection.isUpperUserLeft) {
                    return;
                }

                connection.currentRecorder = null;
                repeatedlyRecordStream(stream);
            });
        }, 30 * 1000); // 30-seconds
    };

    function disableInputButtons() {
        document.getElementById('open-or-join').disabled = true;
        document.getElementById('broadcast-id').disabled = true;
    }

    // ......................................................
    // ......................Handling broadcast-id................
    // ......................................................

    function showRoomURL(broadcastId) {
        var roomHashURL = '#' + broadcastId;
        var roomQueryStringURL = '?broadcastId=' + broadcastId;

        var html = '<h2>Unique URL for your room:</h2><br>';

        html += 'Hash URL: <a href="' + roomHashURL + '" target="_blank">' + roomHashURL + '</a>';
        html += '<br>';
        html += 'QueryString URL: <a href="' + roomQueryStringURL + '" target="_blank">' + roomQueryStringURL + '</a>';

        // var roomURLsDiv = document.getElementById('room-urls');
        // roomURLsDiv.innerHTML = html;

        // roomURLsDiv.style.display = 'block';
    }

    (function() {
        var params = {},
            r = /([^&=]+)=?([^&]*)/g;

        function d(s) {
            return decodeURIComponent(s.replace(/\+/g, ' '));
        }
        var match, search = window.location.search;
        while (match = r.exec(search.substring(1)))
            params[d(match[1])] = d(match[2]);
        window.params = params;
    })();

    var broadcastId = '';
    if (localStorage.getItem(connection.socketMessageEvent)) {
        broadcastId = localStorage.getItem(connection.socketMessageEvent);
    } else {
        broadcastId = connection.token();
    }
    // document.getElementById('broadcast-id').value = broadcastId;
    /*document.getElementById('broadcast-id').onkeyup = function() {
        localStorage.setItem(connection.socketMessageEvent, this.value);
    };*/

    var hashString = location.hash.replace('#', '');
    if (hashString.length && hashString.indexOf('comment-') == 0) {
        hashString = '';
    }

    var broadcastId = params.broadcastId;
    if (!broadcastId && hashString.length) {
        broadcastId = hashString;
    }

    if (broadcastId && broadcastId.length) {
        // document.getElementById('broadcast-id').value = broadcastId;
        localStorage.setItem(connection.socketMessageEvent, broadcastId);

        // auto-join-room
        (function reCheckRoomPresence() {
            connection.checkPresence(broadcastId, function(isRoomExists) {
                if (isRoomExists) {
                    document.getElementById('open-or-join').onclick();
                    return;
                }

                setTimeout(reCheckRoomPresence, 5000);
            });
        })();

        disableInputButtons();
    }

    // below section detects how many users are viewing your broadcast

    connection.onNumberOfBroadcastViewersUpdated = function(event) {
        if (!connection.isInitiator) return;

        document.getElementById('broadcast-viewers-counter').innerHTML = 'Number of broadcast viewers: <b>' + event.numberOfBroadcastViewers + '</b>';
    };
</script>
@endif

<script src="https://cdn.webrtc-experiment.com/common.js"></script>



<script>
    // Set the date we're counting down to
    var countDownDate = new Date("{{$stream->date_time}}").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

        // Get todays date and time
        var now = new Date().getTime();

        // Find the distance between now an the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        document.getElementById("countDown").innerHTML = "Starts in "+ days + "d " + hours + "h "
            + minutes + "m " + seconds + "s ";

        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("countDown").innerHTML = "...";
            @if($subscribedStatus)
            document.getElementById("countDown").innerHTML = "Live...";
            startStreamNow();
            @endif
        }
    }, 1000);
</script>
<script>
    window.setInterval(function(){

        if (!$("#comment").is(":focus")) {
            var elem = $("#comment_view");
            elem.load(baseUrl + "?type=" + comment_type + "&parent_id=" + comment_parent_id);
        }

    }, 8000);
</script>

@endsection