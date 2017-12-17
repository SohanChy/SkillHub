
    $(function() {
        var menu = $("#menu");
        menu.mmenu({
                extensions 		: [ "theme-white", "pagedim-black" ],
                dropdown 		: true,
                // counters		: true,
                dividers		: {
                    add				: true,
                    addTo			: "[id*='sub-categories-']",
                    fixed			: true
                },
                searchfield		: {
                    resultsPanel	: true
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

        menu.removeClass("mui--hide");

    });

