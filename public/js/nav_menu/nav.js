
    $(function() {

        $("#menu").mmenu({
                extensions 		: [ "theme-white", "pagedim-black" ],
                dropdown 		: true,
                counters		: true,
                dividers		: {
                    add				: true,
                    addTo			: "[id*='contacts-']",
                    fixed			: true
                },
                searchfield		: {
                    resultsPanel	: false
                },
                sectionIndexer	: {
                    add				: true,
                    addTo			: "[id*='contacts-']"
                },
                navbar			: {
                    title			: "Categories"
                },
                navbars		: [{
                    content: ["searchfield"]
                }, true]
            },
            {
                dropdown: {
                    offset: {
                        button: {
                            y: $( ".mui--appbar-height" ).height() - 25
                        }
                    }
                } });
        $(".mh-head.mm-sticky").mhead({
            scroll: {
                hide: 200
            }
        });
        $(".mh-head:not(.mm-sticky)").mhead({
            scroll: false
        });


    });