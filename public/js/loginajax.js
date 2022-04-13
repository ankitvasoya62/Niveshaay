jQuery(document).ready(function(){
    jQuery('#login-modal form').submit(function(e){
        e.preventDefault();
        jQuery.ajax({
            url: "/login",
            type:"POST",
            
            data:jQuery('#login-modal form').serialize(),
            success:function(data) {
                console.log('hii');
                if(data == "success"){
                    window.location.href = "/share-detail";
                }
                    
            
            },
            error:function(res){
             console.log(res.status);
            }
        });
    });
});