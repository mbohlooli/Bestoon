function timeNow(i) {
  var d = new Date(),
      h = (d.getFullYear()<2017?'0':'') + d.getFullYear(),
      m = (d.getMonth()<12?'0':'') + d.getMonth();
  i.value = h + '-' + m;
}
