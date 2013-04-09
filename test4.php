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

            Person = Backbone.Model.extend({
                initialize: function() {
                    this.bind('change:name', function() {
                        console.log(this.get('name') + ' is now the value');
                    });
                    this.bind('error', function(model, error) {
                        console.error(error);
                    });
                },
                defaults: {
                    name: 'Super Bob',
                    height: 'ubknown',
                },
                validate: function(attr) {
                    if (attr.name == 'Joe') {
                        return "Fail, Joe!!!";
                    }
                }
            });

            var person = new Person();
            person.set({name: 'Jode', height: '5 metrov'});

            console.log(person.toJSON);


        </script>

    </body>
</html>