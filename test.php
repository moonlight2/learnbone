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
        
         Backbone.sync = function(method, model, success, error){ 
            console.log(success);
            success();
        }
        
        var Item = Backbone.Model.extend({
            defaults: {
                part1: 'hello',
                part2: 'world'
            }
        });
        
        var List = Backbone.Collection.extend({
            model: Item
        });
        
        
        var ItemView = Backbone.View.extend({
            tagName: 'li',
            
            events: {
                'click span.swap': 'swap',
                'click span.delete': 'remove'
            },
            
            initialize: function() {
                _.bindAll(this, 'render', 'unrender', 'swap', 'remove');
                
                this.model.bind('change', this.render);
                this.model.bind('remove', this.unrender);
            },
            
            render: function(){
                //this.el - it is li element
                $(this.el).html('<span style="color:black;">'+this.model.get('part1')+' '+this.model.get('part2')+'</span> &nbsp; &nbsp; <span class="swap" style="font-family:sans-serif; color:blue; cursor:pointer;">[swap]</span> <span class="delete" style="cursor:pointer; color:red; font-family:sans-serif;">[delete]</span>');
                return this; // for chainable calls, like .render().el
            },
            
            unrender: function() {
                $(this.el).remove();
            },
            
            swap: function() {
                var swapped = {
                    part1: this.model.get('part2'),
                    part2: this.model.get('part1')
                }
                this.model.set(swapped);
            },
            
            remove: function() {
                this.model.destroy();
            }
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
                var itemView = new ItemView({
                    model: item
                });
                $('ul', this.el).append(itemView.render().el);
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