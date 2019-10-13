function clicked(int) {
  var str;
  if (int == 1) {
    str = 'First';
  }
  else {
    str = 'Second';
  }
  document.getElementById('changeable').innerHTML = 'You clicked the '+str+' button!';
}
function openMe() {
  x = document.getElementById('openclose');
  x.className="open";
  document.getElementById('openclose').innerHTML="This is open";
}
function closeMe() {
  document.getElementById('openclose');
  x.className="closed";
}
function showProperties(element) {
  document.getElementById('diferentao').innerHTML= element.alt;
}
function showProperties2(element) {
  x = document.getElementsByClassName('class2');
  alert(x.length);
    x[0].className="class3";
  alert(x.length);
}
