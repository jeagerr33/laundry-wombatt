let transactions = JSON.parse(localStorage.getItem("transactions")) || []; // Load data dari localStorage

function addTransaction() {
    const date = document.getElementById("transactionDate").value;
    const startTime = document.getElementById("startTime").value;
    const endTime = document.getElementById("endTime").value;
    const customerName = document.getElementById("customerName").value;
    const machine = document.getElementById("machine").value;

    if (!date || !startTime || !endTime || !customerName || !machine) {
        alert("Harap isi semua data!");
        return;
    }

    // Hitung durasi transaksi dalam menit
    const start = new Date(`${date}T${startTime}`);
    const end = new Date(`${date}T${endTime}`);
    const duration = Math.round((end - start) / (1000 * 60)); // Durasi dalam menit
    const totalCost = Math.ceil(duration / 15) * 10000; // Tarif tetap Rp10.000 per 15 menit

    // Tambahkan transaksi ke array
    transactions.push({ date, startTime, endTime, customerName, machine, duration, totalCost });

    localStorage.setItem("transactions", JSON.stringify(transactions)); // Simpan ke localStorage

    alert("Transaksi berhasil ditambahkan!");
    document.getElementById("transactionForm").reset();
}
