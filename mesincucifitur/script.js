const apiUrl = '/api/mesincuci';

// Tambah Mesin Cuci
function openModalForAdd() {
    const nama = prompt("Masukkan nama mesin cuci:");
    if (!nama) return alert("Nama tidak boleh kosong.");
    const kapasitas = prompt("Masukkan kapasitas mesin cuci (kg):");
    if (!kapasitas || isNaN(kapasitas)) return alert("Kapasitas harus berupa angka.");
    const status = prompt("Masukkan status mesin cuci (kosong/isi):");
    if (!status || (status !== 'kosong' && status !== 'isi')) return alert("Status harus kosong atau isi.");
    const merek = prompt("Masukkan merek mesin cuci:");
    if (!merek) return alert("Merek tidak boleh kosong.");
    const harga = prompt("Masukkan harga per 15 menit:");
    if (!harga || isNaN(harga)) return alert("Harga harus berupa angka.");

    fetch(apiUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ nama, kapasitas, status, merek, harga_per_15_menit: harga })
    })
        .then(response => response.text())
        .then(message => {
            alert(message);
            attachEventListeners(); // Pasang ulang event listener
        })
        .catch(err => console.error('Error:', err));
    

}

// Edit Mesin Cuci
function editMachine(nama) {
    const kapasitas = prompt("Masukkan kapasitas baru (kg):");
    if (!kapasitas || isNaN(kapasitas)) return alert("Kapasitas harus berupa angka.");
    const status = prompt("Masukkan status baru (kosong/isi):");
    if (!status || (status !== 'kosong' && status !== 'isi')) return alert("Status harus kosong atau isi.");
    const merek = prompt("Masukkan merek baru:");
    if (!merek) return alert("Merek tidak boleh kosong.");
    const harga = prompt("Masukkan harga baru per 15 menit:");
    if (!harga || isNaN(harga)) return alert("Harga harus berupa angka.");

    fetch(`${apiUrl}/${nama}`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ kapasitas, status, merek, harga_per_15_menit: harga })
    })
        .then(response => response.text())
        .then(message => {
            alert(message);
            attachEventListeners(); // Pasang ulang event listener
        })
        .catch(err => console.error('Error:', err));

        console.log('Edit Machine:', nama);

}
// Hapus Mesin Cuci
function deleteMachine(nama) {
    if (confirm(`Apakah Anda yakin ingin menghapus mesin cuci "${nama}"?`)) {
        fetch(`${apiUrl}/${nama}`, {
            method: 'DELETE'
        })
            .then(response => response.text())
            .then(message => {
                alert(message);
                attachEventListeners(); // Pasang ulang event listener
            })
            .catch(err => console.error('Error:', err));
    }

    console.log('Delete Machine:', nama);
}

// Menambahkan event listener setelah DOM siap
document.addEventListener('DOMContentLoaded', function () {
    attachEventListeners(); // Tambahkan fungsi ini setelah DOM selesai dimuat
});

function attachEventListeners() {
    // Seleksi ulang tombol edit dan delete setelah tabel dirender
    const editButtons = document.querySelectorAll('.edit-button');
    const deleteButtons = document.querySelectorAll('.delete-button');

    editButtons.forEach(button => {
        const nama = button.getAttribute('data-nama'); // Ambil data-nama dari atribut
        button.addEventListener('click', () => editMachine(nama)); // Pasang event listener
    });

    deleteButtons.forEach(button => {
        const nama = button.getAttribute('data-nama'); // Ambil data-nama dari atribut
        button.addEventListener('click', () => deleteMachine(nama)); // Pasang event listener
    });
}



function searchMachine() {
    const searchValue = document.getElementById('searchBox').value.trim().toLowerCase();
    const rows = document.querySelectorAll('table tbody tr');
    let found = false;

    rows.forEach(row => {
        // Gabungkan semua teks dalam satu baris
        const rowText = Array.from(row.querySelectorAll('td'))
            .map(cell => cell.textContent.toLowerCase())
            .join(' ');

        // Periksa apakah teks pencarian cocok dengan isi baris
        if (rowText.includes(searchValue)) {
            row.style.display = ''; // Tampilkan baris yang cocok
            found = true;
        } else {
            row.style.display = 'none'; // Sembunyikan baris yang tidak cocok
        }
    });

    // Tampilkan pesan jika tidak ada hasil pencarian
    const noResultsMessage = document.getElementById('noResultsMessage');
    if (found) {
        noResultsMessage.style.display = 'none';
    } else {
        noResultsMessage.style.display = 'block';
    }
}



