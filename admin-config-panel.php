<div class="wrap">
<h2>Prodlytic</h2>

<p>This plugin will embed the Prodlytic collector into your WordPress site.</p>

<form method="post" action="options.php">
    <?php settings_fields( 'prodlytic_plugin-settings-group' ); ?>
    <?php do_settings_sections( 'prodlytic_plugin-settings-group' ); ?>

    <h3>Prodlytic Configuration:</h3>
    <p>Please enter your product ID (data-pid) as supplied by Prodlytic. To get a product ID create an account at <a href="https://prodlytic.com/" target="_blank">prodlytic.com</a></p>
    <p>For help and support with Prodlytic visit <a href="http://help.prodlytic.com/">our support page</a>.</p>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Product ID</th>
        <td><input type="text" name="PRODLYTIC_PID" value="<?php echo esc_attr( get_option('PRODLYTIC_PID') ); ?>" /></td>
        </tr>
    </table>

    <?php submit_button(); ?>

</form>
</div>
