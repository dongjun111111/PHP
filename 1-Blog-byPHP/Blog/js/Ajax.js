var xmlHttp;
function xmlhttprequest()//实例化xmlHttp对象
{
  if(window.ActiveXObject)
	{
    xmlHttp=new ActiveXObject('Microsoft.XMLHTTP');
     }
  else if (window.XMLHttpRequest)
	 {
		 xmlHttp=new XMLHttpRequest();
	 }
}
function fun(username)
{
 xmlhttprequest();
 xmlHttp.open("GET","doAjax.php?username="+username,true);
 xmlHttp.onreadystatechange=function()
	{
    document.getElementById('label').innerHTML=xmlHttp.responseText;
    }
 xmlHttp.send(null);
 }
