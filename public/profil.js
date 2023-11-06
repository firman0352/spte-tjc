const input = document.querySelector("#phone");
const output = document.querySelector("#output");
const form = document.querySelector("#form-update-profile");

// initialise plugin
const iti = window.intlTelInput(input, {
    preferredCountries:["id"],
    separateDialCode : true,
    hiddenInput: "full_phone",
    utilsScript: "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.js",
});

const handleChange = () => {
    const inputNow = document.querySelector("#phone");
let text;
if (inputNow.value) {
    text = iti.isValidNumber()
    ? "Valid number!"
    : "Invalid number - please try again";
} else {
    text = "Please enter a valid number below";
}
console.log(text)

const textNode = document.createTextNode(text);

//if valid style green color
if (iti.isValidNumber()) {
    output.style.color = "green";
} else {
    output.style.color = "red";
}

output.innerHTML = "";
output.appendChild(textNode);
};

document.addEventListener('alpine:init', () => {
    Alpine.data('edit', () => ({
        isEdit: false,

        editAble() {
            this.isEdit = true
        },

        submit() {
           const form = document.querySelector("#form-update-profile");

           form.elements['phone'].value = iti.getNumber()

           console.log(iti.getNumber())
            
           if (!iti.isValidNumber()) {
            return false;
            }
            form.submit()

            if (!iti.isValidNumber()) {
                this.isEdit = true
            }
            else {
                this.isEdit = false
            }
        }
    }))
})

// listen to "keyup", but also "change" to update when the user selects a country
input.addEventListener('change', handleChange);
input.addEventListener('keyup', handleChange);