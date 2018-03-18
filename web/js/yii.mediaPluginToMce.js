tinymce.PluginManager.add("filemanager",function(e){
		function browserCallback(field_name, url, type, win){
			var r=window.innerWidth-30;
			var g=window.innerHeight-60;
			if(r>1800&&(r=1800),g>1200&&(g=1200),r>600){
				var d=(r-20)%138;
				r=r-d+10
			}
			console.log(tinymce.activeEditor.windowManager);
			tinymce.activeEditor.windowManager.open({
					file:e.settings.external_filemanager_path,
					width:r,
					height:g,
					resizable: false,
					maximizable:!0,
					inline:1
			}, function(){
				return '/uploads/temp/Chrysanthemum.jpg'
			});
		}
	return tinymce.activeEditor.settings.file_browser_callback = browserCallback;
});