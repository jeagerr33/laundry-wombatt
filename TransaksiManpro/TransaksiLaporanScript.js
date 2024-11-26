let transactions = JSON.parse(localStorage.getItem("transactions")) || []; // Load data dari localStorage

// Render transaksi ke tabel tanpa kolom aksi
function renderTransactions(transactionsToRender) {
    const transactionList = document.getElementById("transactionList");
    transactionList.innerHTML = "";

    transactionsToRender.forEach((transaction) => {
        transactionList.innerHTML += `
            <tr>
                <td>${transaction.date}</td>
                <td>${transaction.startTime}</td>
                <td>${transaction.endTime}</td>
                <td>${transaction.customerName}</td>
                <td>${transaction.machine}</td>
                <td>${transaction.duration}</td>
                <td>${transaction.totalCost}</td>
            </tr>
        `;
    });
}

// Fungsi untuk memfilter transaksi berdasarkan rentang tanggal
function filterTransactions() {
    const startDate = document.getElementById("startDate").value;
    const endDate = document.getElementById("endDate").value;

    if (!startDate || !endDate) {
        alert("Harap isi rentang tanggal!");
        return;
    }

    const filtered = transactions.filter((transaction) => {
        return transaction.date >= startDate && transaction.date <= endDate;
    });

    renderTransactions(filtered);
}

// Tampilkan semua transaksi saat halaman dimuat
window.onload = function () {
    renderTransactions(transactions); // Tampilkan semua transaksi
};
