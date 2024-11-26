package com.example.demo.Pelanggan;

import lombok.*;

@Data
@NoArgsConstructor
@AllArgsConstructor
@Builder
public class Pelanggan {
    private int id;        // ID unik untuk pelanggan
    private String nama;    // Nama pelanggan
    private String noHP;    // Nomor HP pelanggan
    private String email;   // Email pelanggan
}
