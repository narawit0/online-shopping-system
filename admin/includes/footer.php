        </main>
    </div>
</main>
</body>
<script type="text/javascript">
    var dropdown = document.querySelector(".dropdown--button");
    dropdown.addEventListener("click", function() {
        var dropdownList = this.nextElementSibling;
        console.log(dropdownList);
        if(dropdownList.style.display === "block") {
            dropdownList.style.display = "none";
        } else {
            dropdownList.style.display = "block";
        }
    })
</script>
</html>