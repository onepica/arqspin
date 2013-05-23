function ArqballSpin(param) 
{
	var self=this;
	this.container		= document.getElementById(param.containerId);
	this.searchField	= document.getElementById(param.searchFieldId);
	this.button			= document.getElementById(param.buttonId);
	this.requestUrl		= param.requestUrl;
	
	if (this.container) {
		if (this.searchField && this.button) {
			this.button.onclick=function() {
				self.load(self.searchField.value);
			}
		}
		if (tab=document.getElementById(param.tabId)) {
			tab.onclick=function() {
				self.load(self.searchField.value);
			}
		}
	}
}

ArqballSpin.prototype.load = function(searchString)
{
	var self=this;
	new Ajax.Request(this.requestUrl+(searchString && searchString.length ? 'searchString/'+searchString+'/' : ''), {
		method		: 'post',
		data		: {},
		onComplete	: function(data) {
					self.container.innerHTML = data.responseText;
					new ArqballSpinPreview({
						containerId	: self.container.getAttribute('id')
					});
				}
	});
}