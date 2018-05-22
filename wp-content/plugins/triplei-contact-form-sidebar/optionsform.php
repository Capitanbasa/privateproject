<div class="wrap">  
    <?php    echo "<h2>" . __( 'Foolproof Labs Contact Form Settings', 'fpl_settings') . "</h2>"; ?>  
      
    <form name="fpl_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">  
        <input type="hidden" name="fpl_hidden" value="Y">  
        <?php    echo "<h4>" . __( 'Email Address Setting', 'fpl_settings' ) . "</h4>"; ?>  
        <p><?php _e("Email Address to which inquiries will be sent: " ); ?><input type="text" name="fpl_emailTo" value="<?php echo $emailTo; ?>" size="50"><?php _e(" can be multiple, comma separated emails" ); ?>.</p>  
        
    
        <p class="submit">  
        <input type="submit" name="Submit" value="<?php _e('Update Options', 'fpl_settings' ) ?>" />  
        </p>  
    </form>  
</div>  