<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link type="text/css" rel="stylesheet" href="css/style.css" />
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/underscore.js"></script>
        <script type="text/javascript" src="js/backbone.js"></script>
        <script type="text/javascript" src="js/index.js"></script>
    </head>
    <body>


    <div id="myblock">
        
    </div>
    <div class="block">Block</div>
    
        
    <script>
        var ListView = Backbone.View.extend({
            el: $('#myblock'),

            events: {
                'click button#press': 'addItem'
            },
            
            initialize: function(){
                _.bindAll(this, 'render', 'addItem');
                this.render();
                this.counter = 0;
            },

            addItem: function() {
                this.counter ++;
                $('ul', this.el).append("<li>Hello " + this.counter + "</li>");
            },
            
            render: function() {
                $(this.el).append("<button id='press'>Alert</button>");
                $(this.el).append("<ul></ul>");
            }
        });

        var listView = new ListView();
    </script>    
        
        
        
    </body>
</html>