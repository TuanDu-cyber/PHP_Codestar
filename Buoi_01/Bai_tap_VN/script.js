//Textarea
const message = document.querySelector("#message");
const messageCounter = document.querySelector("#messageCounter");
const messageNotice = document.querySelector("#messageNotice");

//An thong bao
messageNotice.style.display = "none";

message.addEventListener("input", () => {
  const length = message.value.length;

  if (length === 140) {
    messageCounter.textContent = "Max 140 / 140";
    messageNotice.style.display = "block";
  } else {
    messageCounter.textContent = "Max " + length + " / 140";
    messageNotice.style.display = "none";
  }
});

//InputField
const inputField = document.querySelector("#inputField");
const inputCounter = document.querySelector("#inputCounter");
const inputNotice = document.querySelector("#inputNotice");

//An thong bao
inputNotice.style.display = "none";

inputField.addEventListener("input", () => {
  const length = inputField.value.length;

  if (length === 20) {
    inputCounter.textContent = "Maximum 20 / 20";
    inputNotice.style.display = "block";
  } else {
    inputCounter.textContent = "Maximum " + length + " / 20";
    inputNotice.style.display = "none";
  }
});
