function ArqSpinPreview(param)
{
	this.container		= document.getElementById(param.containerId);
	this.previewUrl		= (param.previewUrl ? param.previewUrl : 'http://arq.io/i/?is=-0.16&ms=0.16');
	this.width			= 500;
	this.height			= 500;
	
	this.update()
}

ArqSpinPreview.prototype.getPreviewUrl = function(spinId) {
	return this.previewUrl+'&spin='+spinId;
}

ArqSpinPreview.prototype.open = function(spinId) {
	var win = window.open('', 'ArqSpin Preview', 'width='+this.width+',height='+this.height+',menubar=no,toolbar=no,location=no,resizable=no,scrollbars=no,status=no');
	var data='<html><head><title>ArqSpin Preview</title></head>';
	data+='<body style="margin: 0px;">';
	data+='<iframe src="'+this.getPreviewUrl(spinId)+'" width="'+this.width+'" height="'+this.height+'" scrolling="no" frameborder="0"></iframe>';
	data+='</body>';
	data+='</html>';
	win.document.write(data);
	win.focus();
}

ArqSpinPreview.prototype.update = function()
{
	var self=this;
	var list=(this.container ? this.container : document).getElementsByTagName('img');
	for (var key in list) {
		if (list[key].className == 'arqball_spin_preview') {
			list[key].style.cursor	= 'pointer';
			list[key].onclick		= function() {
				self.open(this.getAttribute('shortid'));
			}
		}
	}
}