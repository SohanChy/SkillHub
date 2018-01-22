
    $(function() {
        var menu = $("#menu");
        menu.mmenu({
                extensions 		: [ "theme-white", "pagedim-black" ],
                dropdown 		: true,
                counters		: true,
                dividers		: {
                    add				: true,
                    addTo			: "[id*='sub-categories-']",
                    fixed			: true
                },searchfield		: {
                    panel			: true
                },
                navbar			: {
                    title			: "Library"
                },
                navbars		: [{
                    content: [ "searchfield" ]
                }, true]
            }, {
                searchfield: {
                    clear: true,
                },
                dropdown: {
                    offset: {
                        button: {
                            y: $( ".mui--appbar-height" ).height() - 86,
                            x: +10
                        }
                    }
                }

                }
                );

        menu.removeClass("mui--hide");

        document.getElementById("menu").style.maxWidth = $("siteSearchBarField").width();
        // $("#menu > div.mm-navbars_top > div:nth-child(1)").hide();

        $("#siteSearchBar").click(
            function(){
                var API =  menu.data( "mmenu" );
                var menuDiv = $('#menu');
                var realSearch = menuDiv.find('input[type="text"]');
                var siteSearchBarField = $("#siteSearchBarField");




                if(menuDiv.hasClass("mm-menu_opened") === false){
                    API.closeAllPanels();
                    siteSearchBarField.val("");
                    realSearch.val("");

                    API.open();
                }

                $("#siteSearchBarField").keyup(function() {
                    realSearch.val( this.value );
                    realSearch.trigger("input");
                });

                realSearch.keyup(function() {
                    siteSearchBarField.val(realSearch.val);
                });

            }
        );
    });




