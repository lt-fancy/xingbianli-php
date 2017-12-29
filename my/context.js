var path = window.document.location.href;
var pathName=window.document.location.pathname;
function getContextPath() {
    //获取主机地址，如： http://localhost:8083
    var localhostPaht=path.substring(0,getContextPosition);
    return localhostPaht;
}
function getContextPosition() {
    return pathName.replace("/","");
}