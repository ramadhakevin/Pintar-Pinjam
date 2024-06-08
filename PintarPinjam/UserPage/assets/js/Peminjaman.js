const form = document.querySelector("form"),
        nextBtn = form.querySelector(".nextBtn"),
        backBtn = form.querySelector(".backBtn"),
        allInput = form.querySelectorAll(".first input");


nextBtn.addEventListener("click", ()=> {
    allInput.forEach(input => {
        if(input.value != ""){
            form.classList.add('secActive');
        }else{
            form.classList.remove('secActive');
        }
    })
})

backBtn.addEventListener("click", () => form.classList.remove('secActive'));

function updateJenisBarang() {
    const kategori = document.getElementById('kategori_barang').value;
    const jenisBarang = document.getElementById('jenis_barang');
    jenisBarang.innerHTML = '';

    const options = {
        'audio_visual': ['Kamera', 'Tripod', 'Mic', 'Stabilizer'],
        'olahraga': ['Bola Basket', 'Catur', 'Net Badminton', 'Bola Futsal', 'Raket Badminton'],
        'kreativitas': ['Piano', 'Gitar', 'Biola', 'Alat Band'],
        'lainnya': ['Meja', 'Kursi', 'Kain Backstage']
    };

    if (options[kategori]) {
        options[kategori].forEach(function(item) {
            const option = document.createElement('option');
            option.textContent = item;
            option.value = item.toLowerCase().replace(' ', '_');
            jenisBarang.appendChild(option);
        });
    }

    const defaultOption = document.createElement('option');
    defaultOption.textContent = 'Pilih';
    defaultOption.disabled = true;
    defaultOption.selected = true;
    jenisBarang.insertBefore(defaultOption, jenisBarang.firstChild);
}