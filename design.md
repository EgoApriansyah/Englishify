# Design System — LeapEnglish
### English Learning & TOEFL Platform

---

## 1. Product Brief

**Product:** Englishify — platform belajar bahasa Inggris dan simulasi tes TOEFL.
**Audience:** Mahasiswa dan fresh graduate Indonesia, usia 18–26 tahun.
**Vibes:** Duolingo — playful, colorful, gamified. Terasa seperti main, bukan belajar.
**Font character:** Plus Jakarta Sans — clean, rounded, readable seperti Airbnb Cereal. Tidak ada italic di mana pun.
**Rule:** No gradient. No emoji in UI. No italic. No card radius > 16px.

---

## 2. Color Palette

Sistem warna dibangun dari hijau segar sebagai anchor, lalu diperluas dengan 4 warna aksen yang masing-masing punya peran fungsional — bukan sekadar dekoratif. Hasilnya colorful tanpa kacau.

```
/* Core */
--color-green:       #22C55E   /* Primary brand, CTA utama, badge Correct */
--color-green-dark:  #16A34A   /* Hover state CTA, active nav */
--color-green-light: #DCFCE7   /* Background tag, hover ringan, badge fill */
--color-green-muted: #BBF7D0   /* Progress bar fill, streak track */

/* Accent — masing-masing punya satu peran */
--color-blue:        #3B82F6   /* Listening section, info badge, link */
--color-blue-light:  #DBEAFE   /* Listening tag background */
--color-yellow:      #EAB308   /* Streak, XP bar, "streak active" indicator */
--color-yellow-light:#FEF9C3   /* Streak badge background */
--color-red:         #EF4444   /* Wrong answer, error state, lives lost */
--color-red-light:   #FEE2E2   /* Wrong answer badge background */
--color-purple:      #8B5CF6   /* Writing section, premium badge */
--color-purple-light:#EDE9FE   /* Writing tag background */

/* Neutral — backbone semua teks dan surface */
--color-ink:         #111827   /* Heading utama, teks penting */
--color-body:        #374151   /* Body text default */
--color-muted:       #6B7280   /* Caption, placeholder, label sekunder */
--color-hairline:    #E5E7EB   /* Divider, border card, border input */
--color-surface:     #F9FAFB   /* Background halaman */
--color-canvas:      #FFFFFF   /* Background card, input, navbar */
```

### Peta penggunaan warna

| Warna | Dipakai untuk |
|---|---|
| `green` | CTA primary, badge Correct, nav active, progress |
| `blue` | Semua yang berhubungan dengan Listening |
| `yellow` | Streak harian, XP, reward notification |
| `red` | Jawaban salah, error, lives habis |
| `purple` | Writing section, fitur premium |
| `ink` | Semua heading H1–H4 |
| `body` | Paragraf, deskripsi |
| `muted` | Label, caption, placeholder |
| `surface` | Background halaman (bukan putih — sedikit abu) |
| `canvas` | Background card, navbar, modal |

---

## 3. Typography

### Typeface

```
Semua teks:  "Plus Jakarta Sans", system-ui, -apple-system, sans-serif
Data/angka:  "Plus Jakarta Sans", monospace-fallback (diatur dengan font-variant-numeric: tabular-nums)
```

**Import:**
```html
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
```

**Aturan keras:**
- Tidak ada `font-style: italic` di mana pun, tanpa pengecualian
- Weight yang dipakai: 400 (body), 500 (label), 600 (subheading, button), 700 (heading), 800 (display besar)
- Letter-spacing negatif hanya untuk ukuran 28px ke atas

### Type Scale

| Token | Size | Weight | Line Height | Tracking | Penggunaan |
|---|---|---|---|---|---|
| `display-xl` | 48px | 800 | 1.15 | -0.03em | Hero headline halaman utama |
| `display-lg` | 36px | 700 | 1.2 | -0.02em | Section heading besar |
| `display-md` | 28px | 700 | 1.25 | -0.01em | Page title, modal heading |
| `display-sm` | 22px | 700 | 1.3 | 0 | Card title besar, subsection |
| `title-lg` | 18px | 600 | 1.4 | 0 | Card title, sidebar section |
| `title-md` | 16px | 600 | 1.4 | 0 | Label kuat, nav item aktif |
| `body-lg` | 18px | 400 | 1.65 | 0 | Lead paragraph, instruksi soal |
| `body-md` | 16px | 400 | 1.6 | 0 | Body text default |
| `body-sm` | 14px | 400 | 1.55 | 0 | Caption, meta info, helper |
| `label-lg` | 14px | 600 | 1.4 | 0.04em | Eyebrow, section tag, uppercase label |
| `label-sm` | 12px | 600 | 1.35 | 0.06em | Badge teks, chip, micro label |
| `score-display` | 64px | 800 | 1.0 | -0.04em | Angka skor hasil tes (signature) |
| `xp-number` | 32px | 700 | 1.1 | -0.02em | XP earned, streak count |

### Prinsip

- Display heading tidak pernah lebih dari 2 baris di desktop
- Angka selalu pakai `font-variant-numeric: tabular-nums` supaya tidak loncat saat update
- Eyebrow label di atas heading: `label-lg` + uppercase + `color: green` — bukan muted
- Button label selalu weight 600, size 16px, tidak pernah uppercase kecuali badge kecil

---

## 4. Spacing

Base unit 4px. Semua spacing adalah kelipatan 4.

```
--space-1:   4px
--space-2:   8px
--space-3:   12px
--space-4:   16px
--space-5:   20px
--space-6:   24px
--space-8:   32px
--space-10:  40px
--space-12:  48px
--space-16:  64px
--space-20:  80px
--space-24:  96px
```

### Penggunaan spacing

| Konteks | Nilai |
|---|---|
| Padding dalam card | 20px atau 24px |
| Gap antar card dalam grid | 16px |
| Padding section vertikal | 64px (desktop), 48px (mobile) |
| Padding container horizontal | 32px (desktop), 16px (mobile) |
| Gap antar elemen dalam satu card | 8px atau 12px |
| Margin bawah heading sebelum konten | 16px |

---

## 5. Border Radius

```
--radius-xs:   4px    /* Badge kecil, chip */
--radius-sm:   8px    /* Input, button kecil */
--radius-md:   12px   /* Card standar, dropdown */
--radius-lg:   16px   /* Card besar, modal */
--radius-pill: 9999px /* Tag, badge, progress bar, button pill */
```

Tidak ada radius > 16px pada card atau container. Radius pill hanya untuk elemen kecil (badge, tag, chip, progress bar).

---

## 6. Shadow

Tint shadow menggunakan `#111827` (ink), bukan hitam murni. Hasilnya lebih warm dan tidak terasa dingin.

```
--shadow-sm:   0 1px 2px rgba(17, 24, 39, 0.06);
--shadow-md:   0 4px 12px rgba(17, 24, 39, 0.08), 0 1px 3px rgba(17, 24, 39, 0.05);
--shadow-lg:   0 8px 24px rgba(17, 24, 39, 0.10), 0 2px 8px rgba(17, 24, 39, 0.06);
--shadow-card: 0 1px 3px rgba(17, 24, 39, 0.07), 0 0 0 1px rgba(17, 24, 39, 0.04);
```

Aturan:
- Card default: `shadow-card` (tipis, subtle)
- Card hover: `shadow-md` + `translateY(-2px)`
- Modal: `shadow-lg`
- Navbar scroll: `shadow-sm`

---

## 7. Components

### 7.1 Button

```
/* Primary */
background:    #22C55E (green)
color:         #FFFFFF
font:          Plus Jakarta Sans 600 16px
padding:       12px 24px
height:        48px
border-radius: 12px (radius-md)
hover:         background #16A34A, translateY(-1px)
active:        translateY(0)
transition:    background 120ms ease, transform 120ms ease

/* Secondary */
background:    #FFFFFF (canvas)
color:         #111827 (ink)
border:        1.5px solid #E5E7EB (hairline)
hover:         border-color #22C55E, color #16A34A

/* Danger */
background:    #EF4444 (red)
color:         #FFFFFF

/* Ghost */
background:    transparent
color:         #374151 (body)
hover:         background #F9FAFB

/* Pill variant (untuk streak, reward) */
border-radius: 9999px (pill)
padding:       8px 20px
font-size:     14px weight 600
```

### 7.2 Card

```
background:    #FFFFFF (canvas)
border:        1px solid #E5E7EB (hairline)
border-radius: 12px (radius-md)
shadow:        shadow-card
padding:       20px atau 24px

/* Card variants */

card-lesson:
  Border-left: 4px solid warna section (blue=Listening, green=Reading, purple=Writing)
  Label seksi di atas judul dengan warna aksen

card-score:
  Angka XP/skor besar di kiri (xp-number)
  Label kecil di bawahnya

card-streak:
  Background yellow-light (#FEF9C3)
  Border: 1px solid #EAB308 (yellow)
  Angka streak besar tengah

card-feature (hero card):
  Satu sisi background green (#22C55E), teks putih
  Sisi lain canvas

card-quiz:
  Padding 24px
  Soal dengan body-lg
  Opsi jawaban sebagai radio card (lihat 7.5)
```

### 7.3 Badge / Tag

Setiap seksi punya warna badge sendiri. Ini yang membuat UI terasa colorful tanpa gradient.

```
font:          Plus Jakarta Sans 600 12px
padding:       4px 10px
border-radius: 9999px (pill)
text-transform: uppercase
letter-spacing: 0.06em

/* Variants */
correct:    background #DCFCE7, color #16A34A
wrong:      background #FEE2E2, color #DC2626
listening:  background #DBEAFE, color #1D4ED8
reading:    background #DCFCE7, color #15803D
writing:    background #EDE9FE, color #7C3AED
grammar:    background #FEF3C7, color #B45309
speaking:   background #FCE7F3, color #BE185D
new:        background #22C55E, color #FFFFFF
hot:        background #EF4444, color #FFFFFF
premium:    background #8B5CF6, color #FFFFFF
streak:     background #FEF9C3, color #92400E
xp:         background #DCFCE7, color #166534
```

### 7.4 Progress Bar

```
height:        8px
background:    #E5E7EB (hairline track)
border-radius: 9999px (pill)
fill:          #22C55E (green) untuk progress belajar
fill:          #EAB308 (yellow) untuk XP/streak
fill:          #3B82F6 (blue) untuk level listening
transition:    width 500ms cubic-bezier(0.34, 1.56, 0.64, 1)
```

Easing `cubic-bezier(0.34, 1.56, 0.64, 1)` memberikan bounce kecil saat bar naik — terasa gamified seperti Duolingo.

### 7.5 Answer Option (Radio Card)

Komponen kunci di halaman soal. Bukan radio button biasa.

```
/* Default */
background:    #FFFFFF
border:        1.5px solid #E5E7EB
border-radius: 12px
padding:       16px 20px
cursor:        pointer
transition:    all 120ms ease

/* Hover */
border-color:  #22C55E
background:    #F0FDF4

/* Selected */
border-color:  #22C55E
background:    #DCFCE7
color:         #15803D

/* Correct (setelah submit) */
border-color:  #22C55E
background:    #DCFCE7
icon:          check circle green kanan

/* Wrong (setelah submit) */
border-color:  #EF4444
background:    #FEE2E2
color:         #DC2626
icon:          x circle red kanan
```

Label opsi (A / B / C / D):
```
font:          Plus Jakarta Sans 600 14px
color:         #6B7280 (muted) saat default
color:         #15803D saat selected/correct
width:         28px
height:        28px
border-radius: 9999px
background:    #F3F4F6 saat default, #22C55E saat correct
```

### 7.6 Input / Form

```
background:    #FFFFFF
border:        1.5px solid #E5E7EB
border-radius: 8px (radius-sm)
padding:       12px 16px
height:        48px
font:          Plus Jakarta Sans 400 16px, color #111827

/* Focus */
border-color:  #22C55E
box-shadow:    0 0 0 3px rgba(34, 197, 94, 0.15)
outline:       none

/* Error */
border-color:  #EF4444
box-shadow:    0 0 0 3px rgba(239, 68, 68, 0.12)

/* Placeholder */
color:         #9CA3AF
```

### 7.7 Navbar

```
background:    #FFFFFF (canvas)
height:        64px
border-bottom: 1px solid #E5E7EB
shadow-scroll: shadow-sm (muncul saat scroll > 0)

Logo:
  font:        Plus Jakarta Sans 700 20px
  color:       #111827
  accent dot:  #22C55E (titik hijau setelah nama — signature kecil)

Nav links:
  font:        Plus Jakarta Sans 500 15px
  color:       #6B7280 (muted)
  active:      color #111827, border-bottom 2px solid #22C55E

CTA button di navbar:
  Gunakan Primary button, size sm (padding 10px 20px, height 40px)

XP indicator (dashboard):
  Badge yellow kecil dengan angka XP hari ini
  Selalu tampil di navbar saat sudah login
```

### 7.8 Sidebar Dashboard

```
background:    #111827 (ink dark)
width:         240px
padding:       24px 16px

Logo area:
  padding:     16px
  border-bottom: 1px solid rgba(255,255,255,0.08)

Nav item default:
  font:        Plus Jakarta Sans 500 14px
  color:       rgba(255,255,255,0.55)
  padding:     10px 12px
  border-radius: 8px
  icon:        20px, color sesuai teks

Nav item active/hover:
  background:  rgba(34, 197, 94, 0.15)
  color:       #22C55E
  font-weight: 600

Section label:
  font:        Plus Jakarta Sans 600 11px uppercase
  color:       rgba(255,255,255,0.3)
  letter-spacing: 0.08em
  padding:     16px 12px 8px

Bottom: avatar user + nama + skor TOEFL terakhir
```

### 7.9 Score Display (Signature Component)

Ini elemen paling memorable di seluruh website. Muncul di hero landing page dan halaman hasil tes.

```
Angka skor (misal "677"):
  font:        Plus Jakarta Sans 800 64px
  color:       #111827 (ink)
  letter-spacing: -0.04em
  font-variant-numeric: tabular-nums

Di hero:
  Muncul di dalam "score card" yang melayang di sisi kanan
  Card background: #FFFFFF, border 1px hairline, shadow-lg
  Width: 280px
  Di dalamnya: label "Skor TOEFL", angka besar, 4 sub-skor kecil

Di halaman hasil:
  Angka skor full-width, centered
  Di bawahnya: progress bar 4 seksi
  Di bawahnya lagi: breakdown card per seksi
```

### 7.10 Streak & XP Widget

Elemen gamified yang muncul di dashboard dan navbar.

```
Streak widget:
  background:  #FEF9C3 (yellow-light)
  border:      1px solid #FDE047
  border-radius: 12px
  padding:     16px 20px
  Angka streak: xp-number (32px 700) color #92400E
  Label "hari berturut-turut": body-sm color #78716C
  Icon api: SVG 24px, color #EAB308

XP bar:
  Label "XP Hari Ini":   label-lg green
  Bar:                    progress bar yellow fill
  Angka "340 / 500 XP":  title-md ink
```

---

## 8. Page Layouts

### 8.1 Landing Page

```
[NAVBAR] canvas, 64px

[HERO] surface (#F9FAFB), min-height 90vh
  Layout: 6/12 kiri + 6/12 kanan
  Kiri:
    Eyebrow: label-lg green uppercase — "PLATFORM TOEFL TERPERCAYA"
    Heading: display-xl ink — "Belajar Bahasa Inggris. Raih Skor TOEFL Terbaik."
    Sub: body-lg muted — max 2 baris, tidak menjual
    CTA: [Mulai Gratis] primary + [Lihat cara kerja] ghost
    Social proof: "12.400+ pelajar aktif" — body-sm muted
  Kanan:
    Score card component (shadow-lg, floating)
    3 stat kecil di bawah card: streak / soal / akurasi

[SKILL SECTION] canvas, padding 64px
  Heading: display-lg ink, centered
  Sub: body-lg muted, centered, max-width 560px
  Grid: 4 card skill (Listening/Reading/Writing/Grammar)
  Setiap card: warna badge masing-masing, ikon, judul, deskripsi singkat

[GAMIFICATION SECTION] surface (#F9FAFB), padding 64px
  Layout: 5/12 teks + 7/12 visual
  Teks:
    Eyebrow: label-lg yellow uppercase — "BELAJAR LEBIH SERU"
    Heading: display-md ink
    3 poin: streak, XP, leaderboard — setiap poin dengan icon dan teks singkat
  Visual: Screenshot dashboard dengan streak widget dan XP bar

[SOCIAL PROOF] surface, padding 64px
  Heading: display-md ink, centered
  2 testimonial side-by-side
  Setiap testimonial: nama, universitas, skor sebelum & sesudah (badge)

[HOW IT WORKS] canvas, padding 64px
  3 langkah horizontal — dihubungkan garis putus-putus (bukan numbered 01/02/03)
  Setiap langkah: icon dalam lingkaran green, judul title-md, deskripsi body-sm

[CTA BAND] background ink (#111827), padding 64px
  Heading: display-md putih, centered
  Button: primary green

[FOOTER] canvas, padding 48px 80px
  4 kolom: Brand | Fitur | Tentang | Dukungan
  Teks: body-sm muted
  Garis pemisah: hairline
```

### 8.2 Dashboard

```
[SIDEBAR] ink dark, 240px — fixed

[MAIN AREA] surface, padding 32px
  [HEADER]
    Salam: "Selamat pagi, Ego." display-sm ink
    Sub: body-md muted — "Kamu sudah belajar 14 hari berturut-turut."
    Streak badge di samping nama

  [STAT ROW] 4 card kecil horizontal
    XP hari ini / Soal diselesaikan / Akurasi / Peringkat
    Setiap card: canvas, shadow-card, angka besar (xp-number), label kecil (label-sm)

  [TODAY'S PLAN] canvas card, padding 24px
    Heading: title-lg ink
    3 lesson card vertikal — masing-masing dengan badge seksi berwarna, durasi, tombol Mulai

  [PROGRESS CHART] canvas card, padding 24px
    Heading: title-lg ink
    Line chart 30 hari, warna green
    Garis target: dashed, color muted

  [LEADERBOARD] canvas card, padding 24px, float kanan
    Heading: title-lg ink
    5 baris: rank | avatar | nama | XP
    Row user sendiri: background green-light, bold
```

### 8.3 Halaman Soal

```
[TOP BAR] canvas, sticky, 56px, border-bottom hairline
  Kiri:   Badge seksi berwarna (LISTENING / READING dll)
  Tengah: Progress bar + "Soal 12 dari 50"
  Kanan:  Timer — Plus Jakarta Sans 700 18px
          Default: ink
          < 5 menit: color yellow, background yellow-light
          < 1 menit: color red, background red-light

[CONTENT] max-width 720px, centered, padding 40px 0

  Nomor soal: label-lg green
  Teks soal: body-lg ink, line-height 1.7
  (Listening: custom audio player — bukan browser default)

  Opsi jawaban: 4 answer option card (lihat 7.5)
  Gap antar opsi: 12px

[BOTTOM NAV] canvas, sticky bottom, border-top hairline, padding 16px 32px
  Kiri:  [Soal Sebelumnya] ghost button
  Kanan: [Soal Berikutnya] primary button
  Flag:  icon bendera amber, "Tandai soal ini"
```

### 8.4 Halaman Hasil

```
[SCORE HERO] background ink (#111827), padding 64px, text centered
  Label: label-lg green uppercase — "SKOR TOEFL ITP ESTIMASI"
  Angka: score-display (64px 800) putih
  Level badge: pill badge — "UPPER INTERMEDIATE"
  Sub: body-md rgba(white, 0.6) — "Berdasarkan 150 soal, 12 Juni 2025"

[BREAKDOWN] surface, padding 64px
  3 card horizontal: Listening | Structure | Reading
  Setiap card: badge seksi, angka besar (xp-number), progress bar warna seksi

[ANALISIS] canvas, padding 64px
  2 kolom: Kekuatan | Kelemahan
  Kekuatan: card border-left 4px green
  Kelemahan: card border-left 4px red
  Setiap poin: icon + teks body-md

[RIWAYAT] surface, padding 64px
  Tabel 5 tes terakhir
  Kolom: Tanggal | Total | Listening | Structure | Reading | Tren
  Tren: arrow up green / arrow down red
  Font angka: tabular-nums 600
```

---

## 9. Motion

```
/* Micro-interaction (hover, focus, toggle) */
duration:   120ms
easing:     ease

/* Transition (page element, dropdown muncul) */
duration:   200ms
easing:     ease-out

/* Entrance (scroll-triggered reveal) */
duration:   350ms
easing:     cubic-bezier(0.16, 1, 0.3, 1)

/* Progress bar fill (gamified bounce) */
duration:   500ms
easing:     cubic-bezier(0.34, 1.56, 0.64, 1)

/* Score count-up (halaman hasil) */
duration:   900ms
easing:     ease-out
```

Yang dianimasikan:
- Hover button: `translateY(-1px)` + shadow naik
- Card hover: `translateY(-2px)` + shadow naik
- Answer option selected: background transition 120ms
- Progress bar: width expand dengan bounce easing
- Score count-up: angka naik dari 0 ke skor final
- XP earned notification: slide-in dari bawah, auto-dismiss 3 detik

Yang tidak dianimasikan:
- Background halaman
- Teks body
- Tidak ada animasi looping tanpa trigger user

---

## 10. Iconography

- Library: **Lucide Icons**
- Ukuran: 16px (inline/badge), 20px (nav, button), 24px (card icon), 32px (feature icon)
- Stroke-width: 1.5px default, 2px untuk ikon kecil (< 20px)
- Warna: mengikuti teks di konteksnya — bukan warna independen, kecuali ikon status
- Tidak ada filled icon kecuali saat state aktif/selected

---

## 11. Responsive Breakpoints

```
Mobile:   < 640px    — 1 kolom, padding 16px, sidebar jadi bottom nav
Tablet:   640–1024px — 2 kolom, padding 24px
Desktop:  1024–1280px — Full layout, padding 32px
Wide:     > 1280px   — max-width 1280px, centered
```

Mobile-first untuk halaman soal dan dashboard — mayoritas pengguna mengakses dari HP.

Collapsing:
- Sidebar → bottom navigation bar di mobile (5 icon)
- 4-kolom stat → 2x2 grid di mobile
- Side-by-side card → stack vertikal di mobile
- Score hero angka: turun dari 64px ke 48px di mobile

---

## 12. Accessibility

```
Contrast:
  ink (#111827) on surface (#F9FAFB):       15.8:1  AAA
  white on green (#22C55E):                  3.1:1   AA Large (CTA >= 18px, OK)
  white on ink (#111827):                    17.5:1  AAA
  muted (#6B7280) on canvas (#FFFFFF):        4.6:1  AA

Focus ring (semua elemen interaktif):
  outline: 2px solid #22C55E
  outline-offset: 2px

Touch target minimum: 44x44px
Font minimum: 12px (hanya badge — tidak ada teks penting di bawah 14px)
```

---

## 13. Do & Don't

| Do | Don't |
|---|---|
| Plus Jakarta Sans untuk semua teks | Font lain, font serif, font italic |
| Badge warna berbeda per seksi | Semua badge warna hijau saja |
| Shadow dengan ink tint | Box shadow hitam murni |
| Progress bar dengan bounce easing | Progress bar flat tanpa animasi |
| Answer option sebagai full card | Radio button default browser |
| Navbar sidebar ink dark di dashboard | Sidebar putih seperti halaman biasa |
| Score angka 64px 800 weight | Skor ditampilkan sebagai teks biasa |
| Section berselang surface/canvas/ink | Semua section background sama |
| Warna aksen sesuai seksi (blue=Listening) | Warna aksen acak tanpa makna |
| Eyebrow label green uppercase di heading | Langsung heading tanpa konteks |
