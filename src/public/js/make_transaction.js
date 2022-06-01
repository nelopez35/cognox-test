// Create our number formatter.
const formatter = new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'COP',
    minimumFractionDigits: 0
});

const formatPrice = (val) => {
    let number = val.replace('$', '').replace('.','').replace(',','').trim();
    document.getElementById('amount').value = formatter.format(number);
    document.getElementById('real_amount').value = number;
}

const removeFormat = (val) => {
    let number = val
        .replace('$', '')
        .replace('COP', '')
        .replace(',', '')
        .replace('.','');
    document.getElementById('amount').value = number;

}
