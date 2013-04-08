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
        
        var Item = Backbone.Model.extend({
            defaults: {
                part1: 'hello',
                part2: 'world'
            }
        });
        
        var List = Backbone.Collection.extend({
            model: Item
        });
        
        var ListView = Backbone.View.extend({
            el: $('#myblock'),

            events: {
                'click button#press': 'addItem'
            },
            
            initialize: function(){
                _.bindAll(this, 'render', 'addItem', 'appendItem');
                
                this.collection = new List();
                this.collection.bind('add', this.appendItem);
                
                this.render();
                this.counter = 0;
            },

            addItem: function() {
                this.counter ++;
                var item = new Item();
                item.set({
                    part2: item.get('part2') + this.counter
                });
                this.collection.add(item);
            },
            
            appendItem: function(item) {
                $('ul', this.el).append("<li>" + item.get('part1') + " " + item.get('part2') + "</li>");
            },
            
            render: function() {
                $(this.el).append("<button id='press'>Alert</button>");
                $(this.el).append("<ul></ul>");
                _(this.collection.models).each(function(item){
                    self.appendItem(item);
                }, this);
            }
        });

        var listView = new ListView();
    </script>    
        
        
        
    </body>
</html>