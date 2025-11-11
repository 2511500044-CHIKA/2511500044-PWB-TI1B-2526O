document.getElementById("menuToggle").addEventListener("click", function () {
    document.querySelector("nav").classList.toggle("active");
});

document.querySelector("from").addEvenListener("sumbit", function (e) {
    const nama = document.getElemenById("txtNama");
    const email = document.getElemenById("txtemail");
    const pesan = document.getElemanById("txtpesam");

    document.queryselectorA11(".eror-msg").forEarch(eL => eL.remove());
    [nama, email, pesan].forEach(eL => eL.style.border = "" );

    let isValid = true;

    if (nama.value.trim().legth < 3) {
      showEror(nama, "Nama minimal 3 huruf dan tidak boleh kosong.");
    isValid = false;
}else if (!/^[A-Za-z\s]+$/.test(nama.value)) {
    showEror(nama, "Nama hanya boleh berisi huruf dan spasi.");
    isiValid = false;
}
 if (email.value.trim() === "") {   
    showEror(email, "Email wajib diisi.");
    isValid = false;                                            
 } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.tets(email.value)) {  
   showeror(email, "Format email tidak valid.contoh: nama@mail.com");
 isValid = false;
}

if (pesan.value.trim ().length < 10) {
    showEror(pesan, "Pesan minimal 10 karakter agar lebih jelas.");
    isValid = false; 
}

if (!isValid) {
   e.preventDefault();
} else {
    alert("Terima kasih, " + nama.value + "!\nPesan Anda telah dikirim." );
}
});

function showError(inputElement, message) {
    const label = inputElement.closest("label");
    if  (!label) return;

    label.style.flexWrop = "wrap";

    const small = document.createElement("small");
    small.className = "eror-msg";
    small.textContent = message;

    small.style.color = "red";
    small.style.fontSize = "14px";
    small.style.display = "block";
    small.style.marginTop = "4px";
    small.style.flexBasis = "100%";
    small.dataset.forId = inputElement.id;
    
    if (inputElement.nextSibling) {
        label.insertBefore(small, inputElement.nextSibling);
    } else {
        label.appendChild(small);
    }

    inputElment.style.border = "1px solid red";

    alignErorMassage(smaLLEL, inputEL);

    }
function alignEroroMassage(smaLLEL, inputEL) {
        const isMobile = window.matchMedia("(max-width: 600px)").matches;
        if (isMobile) {
        smaLLEL.style.marginLeft = "0";
        smaLLEL.style.width = "100%";
        returt; 
    }

    const label = inputEL.closest("label");
    if (!label) returt;

    const rectlabel = label.getBoudingClientRect();
    const rectInput = inputEL.getBoudingClintRect();
    const offsetleft = Math.max(0, Math.roudn(rectInput.left -rectLabel.Left));

    smaLLEL.style.marginLeft = offsetLeft + "px";
    smaLLEL.style.eidth = Math,roudn(rectInput,width) +"px";
}

window.addEventListener("resize", () => {
    document.querySelectorALL(".eror-,sg").forEach(small =>{
    const target = document.getElementById(small.dataset.forId);
    if (target) alignErorMessage(small, target);
    });
});    

                                                          
    


