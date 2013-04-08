<script type="text/javascript" src="js/jquery.js"></script>
<script>

    function f() {
        alert(this.name);
    }


    var user = {
        name: 'Ilia'
    };
    
    var f2 = f.bind(user);    
    console.log(f2);
    
    $(function() {
        $('#block').bind('click', f2)
        $('#block').bind('mouseover', f)
    });


</script>


<div id="block">Block</div>