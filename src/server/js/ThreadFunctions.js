function changeContent(arg1) {
  $('#threads').load('./loadthreads.php?category=' + arg1);
}
function searchContent(arg1) {
  $('#threads').load('./loadthreadskeyword.php?search=' + arg1);
}