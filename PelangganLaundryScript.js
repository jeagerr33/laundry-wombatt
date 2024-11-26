let customers = []; // Array untuk menyimpan data pelanggan

// Render data ke tabel
function renderTable() {
    const tableBody = document.getElementById("customer-list");
    tableBody.innerHTML = "";

    customers.forEach((customer, index) => {
        tableBody.innerHTML += `
            <tr>
                <td>${customer.id}</td>
                <td>${customer.name}</td>
                <td>${customer.phone}</td>
                <td>${customer.area}</td>
                <td>
                    <button class="edit-button" onclick="editCustomer(${index})">Edit</button>
                    <button class="delete-button" onclick="deleteCustomer(${index})">Hapus</button>
                </td>
            </tr>
        `;
    });
}

// Buka modal tambah pelanggan
function openAddModal() {
    document.getElementById("addForm").reset();
    document.getElementById("addModal").style.display = "flex";
}

// Tutup modal
function closeModal() {
    document.getElementById("addModal").style.display = "none";
}

// Tambah pelanggan baru
function addCustomer() {
    const name = document.getElementById("addName").value;
    const phone = document.getElementById("addPhone").value;
    const area = document.getElementById("addArea").value;

    if (!name || !phone || !area) {
        alert("Harap isi semua data!");
        return;
    }

    const newCustomer = {
        id: `P${String(customers.length + 1).padStart(3, "0")}`, // ID otomatis
        name,
        phone,
        area,
    };

    customers.push(newCustomer);
    closeModal();
    renderTable();
}

// Hapus pelanggan
function deleteCustomer(index) {
    customers.splice(index, 1);
    renderTable();
}

// Edit pelanggan
function editCustomer(index) {
    const customer = customers[index];
    document.getElementById("addName").value = customer.name;
    document.getElementById("addPhone").value = customer.phone;
    document.getElementById("addArea").value = customer.area;

    document.getElementById("addModal").style.display = "flex";

    // Simpan perubahan
    document.querySelector(".save-button").onclick = function () {
        customer.name = document.getElementById("addName").value;
        customer.phone = document.getElementById("addPhone").value;
        customer.area = document.getElementById("addArea").value;

        closeModal();
        renderTable();
    };
}

// Inisialisasi tabel
renderTable();
