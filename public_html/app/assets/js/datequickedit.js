// Add days buttons
function plusday(inputValue) {
  var getValue = document.getElementById('renewaldate').valueAsDate;
  getValue.setDate(getValue.getDate() + inputValue);
  document.getElementById('renewaldate').valueAsDate = new Date(getValue);
}
// Minus days buttons
function minusday(inputValue) {
  var getValue = document.getElementById('renewaldate').valueAsDate;
  getValue.setDate(getValue.getDate() - inputValue);
  document.getElementById('renewaldate').valueAsDate = new Date(getValue);
}
