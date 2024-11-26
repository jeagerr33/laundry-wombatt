package com.example.demo.MesinCuciStuff;

import lombok.*;

@Data
@NoArgsConstructor
@AllArgsConstructor
@Builder
public class MesinCuciStuff {
    private String nama;                // Nama mesin cuci, bersifat unik
    private int kapasitas;              // Kapasitas mesin cuci (dalam kilogram)
    private String status;              // Status mesin cuci (kosong/isi)
    private String merek;               // Merek mesin cuci
    private double hargaPer15Menit;     // Harga per 15 menit penggunaan mesin cuci
}
