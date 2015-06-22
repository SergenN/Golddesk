function iFrameOn(){
	RichTextField.document.designMode = "On";
	var s = document.getElementById('RichTextField');
	var t = document.getElementById('inhoudinput').value;
	s.contentDocument.write(t);
	
}
function iBold(){
	RichTextField.document.execCommand('bold',false,null);
}
function iUnderline(){
	RichTextField.document.execCommand('underline',false,null);
}
function iItalic(){
	RichTextField.document.execCommand('italic',false,null);
}
function iFontSize(){
	var size = prompt('Enter a size 1 - 7', '');
	RichTextField.document.execCommand('FontSize',false,size);	
}
function iForeColor(){
	var color = prompt('Define a basic color or apply a hexadecimal color for advanced colors:','');
	RichTextField.document.execCommand('ForeColor',false,color);
}
function iHorizontalRule(){
	RichTextField.document.execCommand('InsertHorizotalRule',false,null);
}
function iUnorderedList(){
	RichTextField.document.execCommand('InsertUnorderedList',false,newUL);
}
function iOrderedList(){
	RichTextField.document.execCommand('InsertOrderedList',false,newOL);
}
function iLink(){
	var linkURL = prompt("Enter the URL for this link:", "http://");
	RichTextField.document.execCommand('CreateLink',false,linkURL);
}
function iUnLink(){
	RichTextField.document.execCommand('Unlink',false,null);
}
function iImage(){
	var imgSrc = prompt ('Enter image location','');
	if(imgSrc != null){
		RichTextField.document.execCommand('insertimage',false,imgSrc);
	}
}
function submit_form(){
	
	var theForm = document.getElementById("myform");
	theForm.elements["inhoudinput"].value = window.frames['RichTextField'].document.body.innerHTML;
	theForm.submit();
	
}