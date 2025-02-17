<!doctype html>
<html>
    <head>
        <title>BuilderJS 4.0</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="assets/image/builderjs_color_logo.png" rel="icon" type="image/x-icon" />

        <link rel="stylesheet" href="{{ asset('builder/builder.css') }}">
        <script src="{{ asset('builder/builder.js') }}"></script>

        <!-- Menu -->
        <script src="{{ asset('js/menu.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
        
        <script>
            // Builder parameters
            var params = new URLSearchParams(window.location.search);
            var strict = (params.get('type') == 'custom' ? false : true);
            var tags = [{type: 'label', tag: 'CONTACT_FIRST_NAME'}, {type: 'label', tag: 'CONTACT_LAST_NAME'}, {type: 'label', tag: 'CONTACT_FULL_NAME'}, {type: 'label', tag: 'CONTACT_EMAIL'}, {type: 'label', tag: 'CONTACT_PHONE'}, {type: 'label', tag: 'CONTACT_ADDRESS'}, {type: 'label', tag: 'ORDER_ID'}, {type: 'label', tag: 'ORDER_DUE'}, {type: 'label', tag: 'ORDER_TAX'}, {type: 'label', tag: 'PRODUCT_NAME'}, {type: 'label', tag: 'PRODUCT_PRICE'}, {type: 'label', tag: 'PRODUCT_QTY'}, {type: 'label', tag: 'PRODUCT_SKU'}, {type: 'label', tag: 'AGENT_NAME'}, {type: 'label', tag: 'AGENT_SIGNATURE'}, {type: 'label', tag: 'AGENT_MOBILE_PHONE'}, {type: 'label', tag: 'AGENT_ADDRESS'}, {type: 'label', tag: 'AGENT_WEBSITE'}, {type: 'label', tag: 'AGENT_DISCLAIMER'}, {type: 'label', tag: 'CURRENT_DATE'}, {type: 'label', tag: 'CURRENT_MONTH'}, {type: 'label', tag: 'CURRENT_YEAR'}, {type: 'button', tag: 'PERFORM_CHECKOUT', 'text': 'Checkout'}, {type: 'button', tag: 'PERFORM_OPTIN', 'text': 'Subscribe'}];

            // new builder
            var editor = new Editor({
                canvas: '#contentCanvas',
                sidePanel: '#builderSidebar',

                // emailMode: true,
                strict: strict, // default == true
                showInlineToolbar: true, // default == true
                root: '{{ asset('/builder') }}',
                url: '{{ action([\App\Http\Controllers\DesignController::class, 'preview'], [
                    'path' => $templateItem->baseName,
                ]) }}',

                backCallback: function() {
                    window.location = '/';
                },

                uploadAssetUrl: 'asset.php',
                uploadAssetMethod: 'POST',
                uploadTemplateUrl: 'upload.php',
                uploadTemplateCallback: function(response) {
                    window.location = response.url;
                },
                tags: tags,
                changeTemplateCallback: function(url) {
                    window.location = url;
                },

                /*
                    Disable features: 
                    change_template|export|save_close|footer_exit|help
                */
                // disableFeatures: [ 'widgets', 'change_template', 'export', 'save_close', 'footer_exit', 'help' ], 
                // disableWidgets: [ 'TwoColumnsWidget', 'ThreeColumnsWidget' ],
                // extendedWidgets: [ 'AudioWidget' ],
                // Custom header for: save, changeTemplate, export
                // header: { "Authorize": "KEY-DFDJUELDFDKFJDK" },

                export: {
                    url: 'export.php'
                },

                backgrounds: [
                ],

                loaded: function() {
                    // // New element from obj
                    // var blockElement = new BlockElement($(`
                    //     <div builder-element="BlockElement" style="padding-top:15px;padding-bottom:15px">
                    //         <div class="container">
                    //         </div>
                    //     </div>
                    // `));

                    // // Append to the page element
                    // editor.getPageElement().append(blockElement);

                    // // New element from obj
                    // var pElement = new PElement($(`
                    //     <p builder-element style="margin:0;">
                    //         hahaha hehehe
                    //     </p>
                    // `));

                    // // Append to the block element
                    // blockElement.append(pElement);
                }
            });

            // Events
            $( document ).ready(function() {
                editor.init();
            });
        </script>

        <style>
            .lds-dual-ring {
                display: inline-block;
                width: 80px;
                height: 80px;
            }
            .lds-dual-ring:after {
                content: " ";
                display: block;
                width: 30px;
                height: 30px;
                margin: 4px;
                border-radius: 80%;
                border: 2px solid #aaa;
                border-color: #007bff transparent #007bff transparent;
                animation: lds-dual-ring 1.2s linear infinite;
            }
            @keyframes lds-dual-ring {
                0% {
                    transform: rotate(0deg);
                }
                100% {
                    transform: rotate(360deg);
                }
            }
        </style>
    </head>
    <body  style="overflow:hidden;">
        <div class="wrapper">
            <div class="top container-fluid">
                <div class="row">
                    <div class="col-md-6 top-left float-left">
                        
                    </div>
                    <div class="col-md-6 top-right float-right">
                        <div class="me-auto" style="">
                        </div>
                        <div class="d-flex align-items-center">
                            <a href="{{ action([\App\Http\Controllers\DesignController::class, 'previewWithBuilder'], [
                                'path' => $templateItem->baseName,
                            ]) }}">
                                <button type="button" builder-action="exit" class="btn btn-primary btn-close menu-bar-action d-flex align-items-center">
                                    <i class="fa fa-times"></i>
                                </button>
                            </a>
                        </div>                
                    </div>
                </div>
            </div>
            
            <div class="" style="height: calc(100% - 55px);margin-top:55px;">
                <div class="d-flex" style="height:100%;">
                    <div class="" style="width: calc(100% - 370px)">
                        <div id="contentCanvas" class="border border-right-none" style="height: 100%">
                            <div style="text-align: center;
                                height: 100vh;
                                vertical-align: middle;
                                padding: auto;
                                display: flex;">
                                <div style="margin:auto" class="lds-dual-ring"></div>
                            </div>
                        </div>
                    </div>
                    <div class="" style="width: 370px">
                        <div id="builderSidebar" class="border" style="height: 100%"></div>
                    </div>
                </div>
            </div>
        </div>


        <script>
            switch(window.location.protocol) {
                case 'http:':
                case 'https:':
                  //remote file over http or https
                  break;
                case 'file:':
                  alert('Please put the builderjs/ folder into your document root and open it through a web URL');
                  window.location.href = "./index.php";
                  break;
                default:
                  //some other protocol
            }
        </script>
    </body>
</html>
