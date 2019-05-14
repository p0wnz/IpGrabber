function clear__()
{

    var new_ref = document.location.href.split("?config=")[0];
    var key = document.location.href.split("?config=")[1];
    window.location.href = new_ref+"?clear="+key;
}
function delete__()
{

    var new_ref = document.location.href.split("?config=")[0];
    var key = document.getElementById("linker").value.split("=")[1];
    if ( document.getElementById("linker").value=="") 
    {
        alert("choose an image first!");
        return;
    }
    window.location.href = new_ref+"?delete="+key;
}
function set_link(link)
{
    link_element = document.getElementById("linker");
    var new_ref = document.location.href.split("?config")[0];
    link_element.value = new_ref+"?pic=" + link;
    preview_elemet = document.getElementById("preview");
    if (document.location.href.includes("index.php"))var new_ref = document.location.href.split("index.php?config")[0];
    else var new_ref = document.location.href.split("?config")[0];
    preview_elemet.src = new_ref+"/"+link;
}
function copy()
{
    link_element = document.getElementById("linker");
    link_element.select();
    document.execCommand("copy");
}
function refresh()
{
    location.reload();
}
function main()
{
    var app = document.getElementById("app");
    var item_list = app.innerHTML.split(",");
    var string_app ="";
    string_app = '<div class=\"container\" style=\"margin-top:20px;margin-bottom:20px;\"> \
    <div  class=\"row\"> \
      <div class=\"col \"> \
      <div class="list-group" style=\"overflow-y: scroll; overflow-x:hidden; position :absolute; height:100%; width:90%;\"> \
'
item_list.forEach(item => {
    
    
      if(item!="" && item != "Empty" ) 
      {
        string_app += '<div href="#" style=" width:100%;"class="list-group-item list-group-item-action" onclick=\"set_link(\''+item +'\')\">' +item+ '</div>';
        
      }
  });

  string_app+= ' </div> \
      </div> \
      <div class=\"col\"> \
        <img id=preview src=\"\" width=300 height=300> </img> \
      </div>       <div class=\"col\"> \
      <div class="input-group mb-3">\
    <div class="input-group-prepend">\
        <button class="btn btn-danger " type="button" id="button-addon1" onclick=\"copy()\">Copy link</button>\
    </div>\
    <input id=linker type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">\
    </div> \
    <button class="btn btn-danger" type="button" onclick=\"clear__()\" >clear log</button>\
    <form style="margin-top:10px; border: solid 1px gray; padding:5px;"  action="upload.php" method="post" enctype="multipart/form-data">\
    Select image to upload:\
    <input class="" type="file" name="fileToUpload" id="fileToUpload">\
    <input style="margin-top:10px;" class="btn btn-danger" type="submit" value="Upload Image" name="submit">\
    </form><button class="btn btn-danger" type="button" onclick=\"refresh()\" >refresh</button>\
    <button class="btn btn-danger" type="button" onclick=\"delete__()\" >delete image</button></div></div>  </div>\
    ';

    app.innerHTML = string_app;
}
