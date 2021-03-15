<?php
function xooapp_wp_memory($size){
    $let = substr($size, -1);
    $ret = substr($size, 0, -1);
    switch (strtoupper($let)) {
        case 'P':
            $ret *= 1024;
        case 'T':
            $ret *= 1024;
        case 'G':
            $ret *= 1024;
        case 'M':
            $ret *= 1024;
        case 'K':
            $ret *= 1024;
    }
    return $ret;
}

$max_execution_time  = ini_get("max_execution_time");
$max_input_time      = ini_get("max_input_time");
$upload_max_filesize = ini_get("upload_max_filesize");


if ($max_execution_time < 60 || $max_input_time < 60 || xooapp_wp_memory($upload_max_filesize) < 10485760) {
    
    echo '<div class="error settings-error">';
    
    echo '<br><strong>If Shows any error while demo import, Please resolve following issues and again use quick installer.</strong>';
    echo '<ol>';
    if ($max_execution_time < 60) {
        echo '<li><strong>Maximum Execution Time (max_execution_time) : </strong>' . $max_execution_time . ' seconds. <span style="color:red"> Recommended max_execution_time should be at least 60 Seconds. Add " php_value max_execution_time 600 " line to your .htaccess file: </span></li>';
    }
    if ($max_input_time < 60)
        echo '<li><strong>Maximum Input Time (max_input_time) : </strong>' . $max_input_time . ' seconds. <span style="color:red"> Recommended max_input_time should be at least 60 Seconds.</span>
</li>';
    // if (xooapp_wp_memory(WP_MEMORY_LIMIT) < 100663296) {
    //     echo '<li><strong>WordPress Memory Limit (WP_MEMORY_LIMIT) : </strong>' . WP_MEMORY_LIMIT . ' <span style="color:red"> Recommended memory limit should be at least 96MB. Please refer to : <a target="_blank" href="http://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP">Increasing memory allocated to PHP</a> for more information</span></li>';
    // }
    if (xooapp_wp_memory($upload_max_filesize) < 10485760) {
        echo '<li><strong>Maximum Upload File Size (upload_max_filesize) : </strong>' . $upload_max_filesize . ' <span style="color:red"> Recommended Maximum Upload Filesize should be at least 10MB.</li>';
    }
    
    echo '</ol>';
    
    echo '</div>';
}

echo '<div class="import_message"></div>';



?>


<div id="importer-wrapper">
<br>
<?php _e('<h1>Install Templates - OneClick</h1>', 'consult'); ?><br>


<?php 

$dir = XOOAPP_PLG_DIR . '/demo-importer/data/*';

foreach (glob($dir) as $folder) { 

    // if (basename($folder) != 'main') { ?>

    <div class="import-package">
    <div>
     <form method="post">
         <input type="hidden" name="template" value="<?php echo basename($folder); ?>">
         <div class="theme-preview">
         <img src="<?php echo XOOAPP_PLG_URL. '/demo-importer/data/'. basename($folder) . '/preview.jpg' ?>" alt="thumb">
         </div>
         <h2 class="demo-importer-title"><?php echo basename($folder) ; ?></h2>
         <div class="checkbox-holder">
            <span><input type="checkbox" checked="checked" value="contents" id="contents-checkbox-<?php echo basename($folder);?>" name="contents" /><label for="contents-checkbox-<?php echo basename($folder);?>">Contents</label></span> 
           
            <span><input type="checkbox" checked="checked" value="options" id="options-checkbox-<?php echo basename($folder);?>" name="options" /><label for="options-checkbox-<?php echo basename($folder);?>">Settings</label></span> 
        </div>
        <div class="button-holder">
         <input id="import" type="submit" value="<?php _e('Install', 'consult') ?>" class="button-primary xooapp-import-content-btn" />
         
     </div>

 </form>
</div>
</div>
<?php 
    // }
}
?>


</div>
<script type="text/javascript">
  (function($) {
    "use strict";

        // debugger;

        jQuery('.xooapp-import-content-btn').click(function(e){

           var $serilized = 'template=' + $(this).parents('form').find("input[name='template']").val() +'&';

            $serilized += $(this).parents('form').find("input[type='checkbox']").map(function(){return this.name+"="+this.checked;}).get().join("&");            

           var $import_true = confirm('Are you sure to import dummy content? We highly encourage you to do this action in a WordPress fresh installation!');
            
            if($import_true == false) return;

            $('.import_message').html('<div class="updated settings-success"><div class="import-content-loading">Please wait. This process may take couple of minutes. Sometimes 20/30 seconds later, needs to re-run this process again because of server execution timeout.</div></div>');

           

       var data = {
            action: 'xooapp_ajax_import_options',
            options: $serilized
        };

        // $.post(
        //   ajaxurl, 
        //   data, function(response) {
        //     $('.import_message').html('<div class="updated settings-error">'+ response +'</div>');
        //     alert('Please note that all images & videos that you will see in page sections, sliders are linked from our server. You are allowed to use these images on your testing phase (for better visual guide) of your site and MUST be replaced with your own images/videos before its ready for production.');
        // });

        $.ajax({
          type : 'POST',
          url : ajaxurl,
          data : data,
          success : function (response) {
            $('.import_message').html('<div class="updated settings-success">'+ response +'</div>');
            alert('Please note that all images & videos that you will see in page sections, sliders are linked from our server. You are allowed to use these images on your testing phase (for better visual guide) of your site and MUST be replaced with your own images/videos before its ready for production.');
          },
          error: function (error) {
            $('.import_message').html('<div class="updated settings-error">Opps. :( Please Run This One again</div>');
          }
        });

         $("html, body").animate({ scrollTop: 0 }, "fast");

        e.preventDefault();


    });
})(jQuery);
</script>

