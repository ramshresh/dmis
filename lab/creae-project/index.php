<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <link href="../lib/bootstrap/3/2/0/dist/css/bootstrap.css">
    <link href="../lib/jquery-ui-1-11-2-custom/jquery-ui.css">
</head>
<body>


<script src="../lib/jquery.js"></script>
<script src="../lib/bootstrap/3/2/0/dist/js/bootstrap.js"></script>
<script src="../lib/jquery-ui-1-11-2-custom/jquery-ui.js"></script>
<script>
    var itemNames;
    var itemSubTypes;
    var itemTypes;
    function setItemNames(){
        $.ajax({
            url:"http://localhost/girc/dmis/api/web/items",
            data:{
                "fields":"name"
            },
            success:function(data){
                itemNames=data;
            },
            error:function(){
               return undefined;
            }
        });
    }
    function setItemSubTypes(){
        $.ajax({
            url:"http://localhost/girc/dmis/api/web/item-sub-types",
            data:{
                "fields":"item_name,name"
            },
            success:function(data){
                itemSubTypes=data;
            },
            error:function(){
                return undefined;
            }
        });
    }
    function setItemTypes(){
        $.ajax({
            url:"http://localhost/girc/dmis/api/web/item-types",
            data:{
                "fields":"item_name,type"
            },
            success:function(data){
                itemTypes=data;
            },
            error:function(){
                return undefined;
            }
        });
    }
    setItemNames();
    setItemSubTypes();
    setItemTypes();

</script>
</body>
</html>