<script>
document.getElementById('userSearch').addEventListener('keyup', function() {
  var searchValue = this.value.toLowerCase();
  var tableRows = document.querySelectorAll('#userTable tbody tr');
  tableRows.forEach(function(row) {
    var fullName = row.cells[1].textContent.toLowerCase();
    if (fullName.includes(searchValue)) {
      row.style.display = '';
    } else {
      row.style.display = 'none';
    }
  });
});
</script>