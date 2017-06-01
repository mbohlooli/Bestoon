function timeNow(i) {
  var today = new Date(),
      date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
  i.value = date;
}
