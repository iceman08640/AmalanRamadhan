function convertToRupiah(objek) {
    const separator = ".";
    let a = objek.value;
    let b = a.replace(/[^\d]/g, "");
    let c = "";
    const panjang = b.length;
    let j = 0;

    for (let i = panjang; i > 0; i--) {
        j++;
        c =
            j % 3 === 1 && j !== 1
                ? b.substr(i - 1, 1) + separator + c
                : b.substr(i - 1, 1) + c;
    }
    objek.value = c;
}

function convertToRupiahInt(angka) {
    let rupiah = "";
    const angkarev = angka.toString().split("").reverse().join("");
    for (let i = 0; i < angkarev.length; i++) {
        if (i % 3 === 0) rupiah += angkarev.substr(i, 3) + ".";
    }
    return rupiah
        .split("", rupiah.length - 1)
        .reverse()
        .join("");
}

function convertToRupiahDecimal(number) {
    let numberString = Math.floor(number).toString();
    let formattedRupiah = numberString.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    return formattedRupiah;
}

// function convertToAngka(rupiah) {
//     return parseInt(rupiah.replace(/,.*|[^0-9]/g, ""), 10);
// }
function convertToAngka(rupiah) {
    if (typeof rupiah !== 'string') {
        rupiah = String(rupiah || '');  // Mengonversi ke string, dan memastikan nilai tidak `undefined` atau `null`
    }
    return parseInt(rupiah.replace(/,.*|[^0-9]/g, ""), 10) || 0;
}


function terbilang(bilangan) {
    bilangan = String(bilangan);
    const angka = Array(16).fill("0");
    const kata = [
        "",
        "Satu",
        "Dua",
        "Tiga",
        "Empat",
        "Lima",
        "Enam",
        "Tujuh",
        "Delapan",
        "Sembilan",
    ];
    const tingkat = ["", "Ribu", "Juta", "Milyar", "Triliun"];

    const panjang_bilangan = bilangan.length;

    if (panjang_bilangan > 15) {
        return "Diluar Batas";
    }

    for (let i = 1; i <= panjang_bilangan; i++) {
        angka[i] = bilangan.substr(-i, 1);
    }

    let kalimat = "";
    let j = 0;

    for (let i = 1; i <= panjang_bilangan; i += 3) {
        let subkalimat = "";
        const kata1 =
            angka[i + 2] === "1"
                ? "Seratus"
                : angka[i + 2] !== "0"
                  ? kata[angka[i + 2]] + " Ratus"
                  : "";
        const kata2 =
            angka[i + 1] === "1"
                ? angka[i] === "0"
                    ? "Sepuluh"
                    : angka[i] === "1"
                      ? "Sebelas"
                      : kata[angka[i]] + " Belas"
                : angka[i + 1] !== "0"
                  ? kata[angka[i + 1]] + " Puluh"
                  : "";
        const kata3 =
            angka[i + 1] !== "1" && angka[i] !== "0" ? kata[angka[i]] : "";

        if (angka[i] !== "0" || angka[i + 1] !== "0" || angka[i + 2] !== "0") {
            subkalimat = `${kata1} ${kata2} ${kata3} ${tingkat[j]} `;
        }

        kalimat = subkalimat + kalimat;
        j++;
    }

    if (angka[5] === "0" && angka[6] === "0") {
        kalimat = kalimat.replace("Satu Ribu", "Seribu");
    }

    return kalimat + "Rupiah";
}

function formatBytes(bytes, decimals = 2) {
    if (bytes === 0) return "0 Bytes";
    const k = 1024;
    const sizes = ["Bytes", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB"];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return (
        parseFloat((bytes / Math.pow(k, i)).toFixed(decimals)) + " " + sizes[i]
    );
}
