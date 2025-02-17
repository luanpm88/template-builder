// Events
$(function() {
    // Design --> New
    $('[builder-action="new"]').on('click', function() {
        editor.newDesign();
    });

    // Design --> Clear
    $('[builder-action="clear"]').on('click', function() {
        editor.clearDesign();
    });

    // Design --> New From Template
    $('[builder-action="new-from-template"]').on('click', function() {
        var templatePopup = new PopUp('Select template');
        var contentPopup = '<div>' + $('#templateToolbox').html() + '</div>';

        templatePopup.loadHtml(contentPopup);
    });

    // Design --> Upload Template
    $('[builder-action="upload"]').on('click', function() {
        editor.showUploadTemplatePopup();
    });

    // Design --> Save; Top Right Save button
    $('[builder-action="save"]').on('click', function() {
        editor.save();
    });

    // Save & Close button
    $('[builder-action="save-close"]').on('click', function() {
        editor.save(function() {
            // go back after saved
            editor.back();
        });
    });

    

    // Design --> Exit; Top Right Exit button
    $('[builder-action="exit"]').on('click', function(e) {
        e.preventDefault();
        editor.back();
    });

    // Preview --> Desktop
    $('[builder-action="preview-desktop"]').on('click', function() {
        editor.showPreview('desktop');
    });

    // Preview --> Mobile
    $('[builder-action="preview-mobile"]').on('click', function() {
        editor.showPreview('mobile');
    });

    // Mode Design --> Design
    $('[builder-action="mode-design"]').on('click', function() {
        editor.viewDesign();
    });

    // Mode Design --> Source
    $('[builder-action="mode-source"]').on('click', function() {
        editor.viewSource();
    });

    // Change Template --> [Template Name]
    $('[builder-action="change-template"]').on('click', function() {
        var template_url = $(this).attr('template-url');
        
        editor.changeTemplate(template_url);
    });

    // Change to mobile mode
    $(document).on('click', '[builder-action="mode-mobile"]', function() {
        editor.backgroundModeMobile();
    });

    // Change to tablet mode
    $(document).on('click', '[builder-action="mode-tablet"]', function() {
        editor.backgroundModeTablet();
    });

    // Change to desktop mode
    $(document).on('click', '[builder-action="mode-desktop"]', function() {
        editor.backgroundModeDesktop();
    });

    // Click help to show help box
    $('[builder-action="show-help-box"]').on('click', function() {
        editor.showHelpSlideBox();
    });
    
    // Export / Download template
    $('[builder-action="export"]').on('click', function(e) {
        editor.exportTemplate();
    });
});

$(function() {
    //js choose template builder
    $('*:not(.menu-bar)').on('click', function(e) {
        if ($(e.target).closest('.action-preview, ul.display, .view-mode, ul.display-view-mode, .design-menu, ul.design, .action-choose-template, ul.display-template').length) {
            $('div.template-thumbnail').hide();
            return;
        }

        $('div.template-thumbnail').hide();

        $('.action-choose-template').removeClass('add-background-choose');
        $('ul.display-template').removeClass('display-choose-template');
        //remove view source
        $('.view-mode').removeClass('add-background-color');
        $('ul.display-view-mode').removeClass('hienlen');
        //remove design
        $('.design-menu').removeClass('add-background-design');
        $('ul.design').removeClass('display-menu');

        $('.preview-page').removeClass('add-background-color');
        $('.preview-page').find('ul.display').removeClass('hienlen');
    });

    //js nut chon design menu
    $('.design-menu').on('click', function() {
        $(this).toggleClass('add-background-design');
        $(this).find('ul.design').toggleClass('display-menu');

        //remove choose
        $('.action-choose-template').removeClass('add-background-choose');
        $('ul.display-template').removeClass('display-choose-template');

        //remove view source
        $('.view-mode').removeClass('add-background-color');
        $('ul.display-view-mode').removeClass('hienlen');

        //remove preview
        $('.action-preview').removeClass('add-background-color');
        $('ul.display').removeClass('hienlen');
    });

    //js nut chon action hien preview design
    $('.preview-page').on('click', function() {
        $(this).toggleClass('add-background-color');
        $(this).find('ul.display').toggleClass('hienlen');

        //remove choose
        $('.action-choose-template').removeClass('add-background-choose');
        $('ul.display-template').removeClass('display-choose-template');
        //remove view source
        $('.view-mode').removeClass('add-background-color');
        $('ul.display-view-mode').removeClass('hienlen');
        //remove design
        $('.design-menu').removeClass('add-background-design');
        $('ul.design').removeClass('display-menu');
    });

    //js nut chon action view mode design, source
    $('.view-mode').on('click', function() {
        $(this).toggleClass('add-background-color');
        $(this).find('ul.display-view-mode').toggleClass('hienlen');

        //remove choose
        $('.action-choose-template').removeClass('add-background-choose');
        $('ul.display-template').removeClass('display-choose-template');
        //remove preview
        $('.action-preview').removeClass('add-background-color');
        $('ul.display').removeClass('hienlen');
        //remove design
        $('.design-menu').removeClass('add-background-design');
        $('ul.design').removeClass('display-menu');
    });

    //js choose template builder
    $('.action-choose-template').on('click', function() {
        $(this).toggleClass('add-background-choose');
        $(this).find('ul.display-template').toggleClass('display-choose-template');
        //remove preview
        $('.action-preview').removeClass('add-background-color');
        $('ul.display').removeClass('hienlen');
        //remove view source
        $('.view-mode').removeClass('add-background-color');
        $('ul.display-view-mode').removeClass('hienlen');
        //remove design
        $('.design-menu').removeClass('add-background-design');
        $('ul.design').removeClass('display-menu');

        $('div.template-thumbnail').hide();
    });

    //hover li template show image thumbnail
    $('li.hover-name-template').on('mouseover', function() {
        var thumbnail = $(this).attr('data-thumbnail');
        var url = $(this).attr('template-url');
        $('.template-thumbnail img.img-template').attr('template-url', url);
        $('.template-thumbnail img.img-template').attr('src', thumbnail);
        $('.template-thumbnail').show();
    });

    //js click action mode preview design
    $(document).on('click', 'li.device', function() {
        $('.icon-mode').css('color', 'rgb(150, 150, 150)');
        $(this).find('.icon-mode').css('color', 'white');
        $('.content-background').removeClass('mode-mobile');
        $('.content-background').removeClass('mode-tablet');
        $('.content-background').removeClass('mode-desktop');
        
        var mode = $(this).attr('data-mode');
        $('img.bg-image').attr('data-mode', mode);
        $('li.change-background').attr('data-mode', mode);
    });
});

