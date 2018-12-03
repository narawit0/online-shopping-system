        </main>
    </div>
</main>
</body>
<script type="text/javascript">
    var dropdown = document.querySelectorAll(".dropdown--button");
    for(var i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
        var dropdownList = this.nextElementSibling;
        if(dropdownList.style.display === "block") {
            dropdownList.style.display = "none";
        } else {
            dropdownList.style.display = "block";
        }
    })
    }
</script>
</html>