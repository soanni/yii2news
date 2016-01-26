<?php
    $this->registerCss('
        .column{
            border: 1px solid black;
        }
        #layout{
            position: relative;
            margin: 0pt auto;
            width: 1400px;
        }
        #colSx{
            float:left;
            width: 150px;
        }
        #colDx{
            float:left;
            width: 150px;
        }
        #colCenter{
            float:left;
            width: 1000px;
        }'
    );

    $this->registerJs(
        "function resizeLayout()
        {
            var windowWidth = $(window).width();

            if(windowWidth > 1400)
            {
                $('#colSx').css('display', 'block');
                $('#colCenter').css('display', 'block');
                $('#colDx').css('display', 'block');
                $('#layout').css('width', 1400);
            }
            else if((windowWidth>1200)&&(windowWidth<=1400))
            {
                $('#colSx').css('display', 'block');
                $('#colCenter').css('display', 'block');
                $('#colDx').css('display', 'none');
                $('#layout').css('width', 1200);
            }
            else if(windowWidth<1200)
            {
                $('#colSx').css('display', 'none');
                $('#colCenter').css('display', 'block');
                $('#colDx').css('display', 'none');
                $('#layout').css('width', 1000);
            }

        }

        $(window).resize(function() {
                resizeLayout();
        });

        $(function() {
                resizeLayout();
        });"
    );
?>
<div id="layout">
    <div id="colSx" class="column">
        Content of colSx
    </div>
    <div id="colCenter" class="column">
        Content of colCenter
    </div>
    <div id="colDx" class="column">
        Content of colDx
    </div>
</div>

