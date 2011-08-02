<head>
	<script type="text/javascript" src="/js/mootools.js"></script>
    <script type="text/javascript" src="/js/Swiff.Uploader.js"></script>
    <script type="text/javascript" src="/js/Fx.ProgressBar.js"></script>
    <script type="text/javascript" src="/js/FancyUpload2.js"></script>
 
   	<script>
   	window.addEvent('load', function() {
 
var swiffy = new FancyUpload2($('demo-status'), $('demo-list'), {
url: $('form-demo').action,
fieldName: 'photoupload',
path: '/js/Swiff.Uploader.swf',
limitSize: 2 * 1024 * 1024, // 2Mb
onLoad: function() {
$('demo-status').removeClass('hide');
$('demo-fallback').destroy();
},
// The changed parts!
debug: true, // enable logs, uses console.log
target: 'demo-browse' // the element for the overlay (Flash 10 only)
});
 
filter = {'Images (*.jpg, *.jpeg, *.gif, *.png)': '*.jpg; *.jpeg; *.gif; *.png'};
swiffy.options.typeFilter = filter;
/**
* Various interactions
*/
 
$('demo-browse').addEvent('click', function() {
/**
* Doesn't work anymore with Flash 10: swiffy.browse();
* FancyUpload moves the Flash movie as overlay over the link.
* (see opeion "target" above)
*/
swiffy.browse();
return false;
});

/**
* The *NEW* way to set the typeFilter, since Flash 10 does not call
* swiffy.browse(), we need to change the type manually before the browse-click.
*/
$('demo-select-images').addEvent('change', function() {
var filter = null;
if (this.checked) {
filter = {'Images (*.jpg, *.jpeg, *.gif, *.png)': '*.jpg; *.jpeg; *.gif; *.png'};
}
swiffy.options.typeFilter = filter;
});
 
$('demo-clear').addEvent('click', function() {
swiffy.removeFile();
return false;
});
 
$('demo-upload').addEvent('click', function() {
swiffy.upload();
return false;
});
});
   	
   	</script>
</head>
<form action="/doUpload.php" method="post" enctype="multipart/form-data" id="form-demo">
<fieldset id="demo-fallback">
<label for="demo-photoupload">

<input type="file" name="photoupload" id="demo-photoupload" />
</label>
</fieldset>
 
<div id="demo-status" class="hide">
<p>
<a href="#" id="demo-browse">Explorer les fichiers</a> |
<input type="checkbox" id="demo-select-images" checked /> Images uniquement |
<a href="#" id="demo-clear">Effacer la liste</a> |
<a href="#" id="demo-upload">Upload !</a>
</p>
<div>
<strong class="overall-title">Progression totale</strong><br />
<img src="/images/assets/progress-bar/bar.gif" class="progress overall-progress" />
</div>
<div>
<strong class="current-title">Progression du fichier</strong><br />
<img src="/images/assets/progress-bar/bar.gif" class="progress current-progress" />
</div>
<div class="current-text"></div>
</div>
 
<ul id="demo-list"></ul>
</form>