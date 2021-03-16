CKEDITOR.editorConfig = function( config ) {	
    config.language = 'fr';
	config.height = 100; 
	config.toolbarGroups = [
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] }
	];	
    config.removePlugins = 'easyimage, cloudservices';
	config.removeButtons = 'Source,Save,Templates,NewPage,Preview,Print,Cut,Copy,Paste,CopyFormatting,RemoveFormat,Form,HiddenField,ImageButton,Checkbox,Radio,Textarea,Select,Button,Scayt,Undo,Redo,Replace,Find,SelectAll,Subscript,Superscript,Blockquote,CreateDiv,BidiLtr,BidiRtl,Language,Anchor,EasyImageUpload,Flash,HorizontalRule,SpecialChar,PageBreak,Iframe,Styles,Format,Maximize,ShowBlocks,About';
};