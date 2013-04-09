<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link type="text/css" rel="stylesheet" href="css/style.css" />
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/underscore.js"></script>
        <script type="text/javascript" src="js/backbone.js"></script>
    </head>
    <style type="text/css">
        #container { padding:20px; border:1px solid #333; width:400px; }
        #list-template { display:none; }
    </style>
    <body>
        <div id="container">
            <button>Load</button>
            <ul id="list">
            </ul>
        </div>

        <div id="list-template">
            <li><a href=""></a></li>
        </div>

        <script>

            var model = new Backbone.Model({
                data: [
                    {text: "Google", href: "http://google.com"},
                    {text: "Facebook", href: "http://facebook.com"},
                    {text: "Youtube", href: "http://youtube.com"}
                ]
            });

            var View = Backbone.View.extend({
                initialize: function() {
                    this.template = $('#list-template').children();
                },
                el: '#container',
                events: {
                    'click button': 'render'
                },
                render: function() {
                    var data = this.model.get('data');
                    for (var i = 0; i<data.length; i++) {
                        var li = this.template.clone().find('a').attr('href', data[i].href).text(data[i].text).end();
                        $(this.el).children('ul').append(li);

                    }
                }
            });

            var view = new View({model: model});

        </script>

    </body>
</html>