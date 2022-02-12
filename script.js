window.addEventListener('load', function (){
    document.getElementById('loadBtn').addEventListener("click", function () {
        let xhr = new XMLHttpRequest();

        xhr.onload = function() {
            if (xhr.status === 200) {
                let data = xhr.responseText;
                console.log(data);
            } else if (xhr.status === 404) {
                console.log("No records found")
            }
        }
        xhr.open("GET", "load.php", true);
        xhr.send();
    })

    document.getElementById('search').addEventListener('click', function (){
        let inpText = document.getElementById('text').value;
        const data = 'text='+inpText;
        if (inpText.length > 2) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "search.php", true);

            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            xhr.onload  = function() {
                if (xhr.status === 200) {
                    let data = xhr.responseText;
                    //console.log(data);
                    let tbody = document.getElementsByTagName('tbody')[0];
                    tbody.innerHTML = "";
                    tbody.innerHTML = data;
                } else if (xhr.status === 404) {
                    console.log("No records found")
                }
            }

            xhr.send(data);


        }
    })

    document.getElementById('text').onclick = function () {
        this.select();
    }
})