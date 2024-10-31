var za__text = document.getElementById("translated-text");

/*****************/
//**API Request**//
/*****************/

async function postData(url = "", apiKey) {
  var data__Val = za__text.value.replace(/(?:\r\n|\r|\n)/g, " 4444 ");
  var form_data = {
    data: data__Val,
    lang: "es",
    mode: 1,
    style: 1,
  };
  // Default options are marked with *
  const response = await fetch(url, {
    method: "POST",
    mode: "cors",
    cache: "no-cache",
    credentials: "same-origin",
    headers: {
      "Content-Type": "application/json",
      Authorization: "Bearer " + auth.pin,
    },
    redirect: "follow",
    referrerPolicy: "no-referrer",
    body: JSON.stringify(form_data),
  });

  return response.json();
}

/*****************/
//**Form Submit**//
/*****************/

document
  .getElementById("run-translation")
  .addEventListener("click", function (e) {
    e.preventDefault();

    if (
      za__text.value == "" ||
      za__text.value == null ||
      za__text.value == "undefined"
    ) {
      alert("Please fill all the fields");
      reset__form();
      return false;
    }

    document.getElementById("loader_img").style.display = "grid";

    //////////////////////
    //Call Post Function//
    //////////////////////

    return__data = postData(
      "https://www.reescribirtextos.net/api/parafraserText/wordpress"
    );
    return__data
      .then(function (response) {
        if (response.message == "Success") {
          hideError();
          response__result = response.result.replaceAll("4444", "</br>");
          document.getElementById("result").innerHTML = response__result;
          document.getElementById("loader_img").style.display = "none";
          document.getElementById("za__form").style.display = "none";
          document.getElementById("za__results").style.display = "inline-table";
          div__text = document.getElementById("result").innerText;
          document.getElementById("wordCount2").innerText =
            wordcount(div__text);
        } else {
          if (response.error.auth !== '') {
            showError("Your Auth key is invalid. Please click <a href='https://www.reescribirtextos.net/' target='_blank'>here</a> to get new Auth key");
          }
          else {
            showError(response.error);
          }
          reset__form();
        }
      })
      .catch((error) => {
        showError("Your Auth key is invalid. Please click <a href='https://www.reescribirtextos.net/' target='_blank'>here</a> to get new Auth key");

      });
  });

/****************/
//**Reset Form**//
/****************/
function reset__form() {
  za__text.value = "";
  document.getElementById("result").innerHTML = "";
  document.getElementById("loader_img").style.display = "none";
  document.getElementById("za__form").style.display = "block";
  document.getElementById("za__results").style.display = "none";
  document.getElementById("wordCount1").innerHTML = "0";
}
document.getElementById("cancel-text").addEventListener("click", (e) => {
  e.preventDefault();
  reset__form();
});

/***********************/
//**Copy to Clipboard**//
/***********************/

document.querySelector("#copyBtn").addEventListener("click", function (e) {
  let div = document.getElementById("result");
  let text = div.innerText;
  let textArea = document.createElement("textarea");
  textArea.width = "1px";
  textArea.height = "1px";
  textArea.background = "transparents";
  textArea.value = text;
  document.body.append(textArea);
  textArea.select();
  document.execCommand("copy");
  document.body.removeChild(textArea);
  this.setAttribute(
    "data-title",
    document.querySelector("#copiedDataTitle").innerText
  );
  setTimeout(() => {
    this.setAttribute(
      "data-title",
      document.querySelector("#copyDataTitle").innerText
    );
  }, 2000);
});

/****************/
//**Word Count**//
/****************/

function wordcount(s) {
  return s.replace(/-/g, " ").trim().split(/\s+/g).length;
}

za__text.addEventListener("input", (e) => {
  document.getElementById("wordCount1").innerText = wordcount(za__text.value);
});

/***********************/
//******ToolTip*********/
/***********************/
replaceText = (e) => {
  var synonymsWord = e.target.innerText;
  var currentIndex = document.getElementById("zaChangeIndex").value;

  document.getElementsByClassName("qtiperar")[currentIndex].innerText =
    synonymsWord;
  document
    .getElementsByClassName("qtiperar")
  [currentIndex].setAttribute("style", "");
  //   document.getElementsByClassName("qtiperar")[currentIndex].outerHTML = "";
  document.getElementsByClassName("qtiperar")[currentIndex].className = "";

  document.getElementById("tooltip").innerText = "";
  document.getElementById("tooltip").style.display = "none";
};

document.querySelector("#tooltip").addEventListener("click", function (e) {
  if (e.target.classList.contains("el__val")) {
    replaceText(e);
  }
});

document.querySelector("body").addEventListener("click", function (e) {
  if (e.target.classList.contains("qtiperar") == false) {
    document.querySelector("#tooltip").style.display = "none";
  }
});

showTooltip = (e) => {

  var offset = e.pageX;

  var topOff = e.pageY + 10;
  document.getElementById("tooltip").style.top = topOff + "px";
  document.getElementById("tooltip").style.left = offset + "px";
  document.getElementById("tooltip").style.display = "block";
};

document.querySelector("body").addEventListener("click", function (e) {
  if (e.target.classList.contains("qtiperar")) {
    elms = e.target.getAttribute("data-title");
    elms = elms.split("|");
    ul = "<ul>";
    elms.forEach((element) => {
      ul += `<li> <span class="el__val"> ${element} </span> </li>`;
    });
    ul += "</ul>";
    document.getElementById("tooltip").innerHTML = ul;
    showTooltip(e);
    setValues(e);
    // replaceText(e);
  }
});

function setValues(e) {
  text = e.target.innerText;
  var indexNo = "";
  Array.from(document.getElementsByClassName("qtiperar")).forEach(
    (element, index) => {
      if (e.target == document.getElementsByClassName("qtiperar")[index]) {
        indexNo = index;
      }
    }
  );
  document.getElementById("zaChangeIndex").value = indexNo;
  const last = text.charAt(text.length - 1);
  text = text.replace(/\.$/, "");
  text = text.replace(/\,$/, "");
  text = text.replace(/\!$/, "");
  text = text.replace(/\?$/, "");
  text = text.replace(/\:$/, "");
  current = e.target;
}
function hide($element) {
  $element.style.display = "none";
  $element.style.opacity = 0;
}
function show($element, display = "block") {
  $element.style.display = display;
  $element.style.opacity = 1;
  $element.style.visibility = "visible";
}
function showError(error) {
  show(document.getElementById("errorDiv"));
  document.querySelector("#errorDiv > #errorSpan").innerHTML = error;
}
function hideError() {
  hide(document.getElementById("errorDiv"));
  document.querySelector("#errorDiv > #errorSpan").innerHTML = "";
}