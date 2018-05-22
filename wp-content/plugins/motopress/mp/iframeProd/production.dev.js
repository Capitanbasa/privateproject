if (typeof jQuery == 'undefined') {
    steal.map('jquery/jquery.js', parent.motopress.wpJQueryUrl + 'jquery.js')
    .then(parent.motopress.wpJQueryUrl + 'jquery.js');
} else {
    steal.loaded('jquery/jquery.js');
}
steal.then(
    'bootstrap/bootstrap-icon.min.css' + parent.motopress.pluginVersionParam,
    'mp/css/mpIframe.css' + parent.motopress.pluginVersionParam,
    'bootstrap/select/bootstrap-select.css' + parent.motopress.pluginVersionParam,
    parent.motopress.wpCssUrl + 'jquery-ui-dialog.css' + parent.motopress.pluginVersionParam
)
.then('bootstrap/bootstrap.min.js' + parent.motopress.pluginVersionParam)
.then('bootstrap/bootstrapx-clickover-master/bootstrapx-clickover.js' + parent.motopress.pluginVersionParam)
.then('bootstrap/select/bootstrap-select.js' + parent.motopress.pluginVersionParam)
.then(function($) {$.getScript(parent.MP.Settings.loadScriptsUrl);})
.then('mp/iframeProd/concat.js' + parent.motopress.pluginVersionParam,
    function($) {
        //jQuery.noConflict(true);
        new MP.Grid($('#motopress-grid'));
        new MP.LeftMenu();
        new MP.DragDrop();
    }
);