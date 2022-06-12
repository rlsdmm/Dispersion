
//---------------------------------Config Firebase--------------------------------//

import { initializeApp } from 
"https://www.gstatic.com/firebasejs/9.8.2/firebase-app.js";

const firebaseConfig = {
    apiKey: "AIzaSyC74Lsli79zjvsxC_5PPbhIbydNOnE4030",
    authDomain: "manga-83f1d.firebaseapp.com",
    databaseURL: "https://manga-83f1d-default-rtdb.firebaseio.com",
    projectId: "manga-83f1d",
    storageBucket: "manga-83f1d.appspot.com",
    messagingSenderId: "683431314893",
    appId: "1:683431314893:web:7e218b42174f05f2b97084",
    measurementId: "G-GZ4TJMLK6V"
  };

  const app = initializeApp(firebaseConfig);

  import {getFirestore, doc, getDoc, getDocs, setDoc, onSnapshot, collection} from "https://www.gstatic.com/firebasejs/9.8.2/firebase-firestore.js";

  const db = getFirestore();


//---------------------------------Referencias--------------------------------//

let title = document.getElementById('title')
let description = document.getElementById('description');
let genre = document.getElementById('genre');
let rating = document.getElementById('rating');
let image = document.getElementById('image')


var btncreate = document.getElementById('btncreate');
var btnread = document.getElementById('btnread');
var btnremove = document.getElementById('btnremove');
var btnupdate = document.getElementById('btnupdate');


//---------------------------------Preencher Table--------------------------------//
var mangaNo = 0;
var tbody = document.getElementById('tbody1')
function addTable (title, image, description, genre, rating) {
  let trow = document.createElement("tr");
  let td1 = document.createElement("img")  
  let td2 = document.createElement("td")  
  let td3 = document.createElement("td")  
  let td4 = document.createElement("td")  
  let td5 = document.createElement("td")
  let td6 = document.createElement("td")

  td1.classList = ("thumbnail");
  
  td1.innerHTML = image
  td1.src = image
  td2.innerHTML = title
  td3.innerHTML = description
  td4.innerHTML = genre
  td5.innerHTML = rating
  td6.innerHTML = ++mangaNo

  trow.appendChild(td1)
  trow.appendChild(td2)
  trow.appendChild(td3)
  trow.appendChild(td4)
  trow.appendChild(td5)
  trow.appendChild(td6)

  tbody.appendChild(trow)
 }

//---------------------------------Inserir--------------------------------//

function addAll (Mangafun) {
  mangaNo = 0
  tbody.innerHTML= ""
  Mangafun.forEach(element => {
    addTable(element.title, element.image, element.description, element.genre, element.rating)
  })
}

//---------------------------------Tempo Real--------------------------------//

  async function gimmeRealTime() {
    const dbRef = collection(db, "Manga");

    onSnapshot(dbRef, (querySnapshot)=> {
      var manga = [];
      querySnapshot.forEach(doc => {
        manga.push(doc.data())
      })
      addAll(manga);
    })
  }

//---------------------------------Inserir2--------------------------------//


 function insertData() {
     setDoc(doc(db, "Manga", title.value), {
      title: title.value,
      image: image.value,
      description: description.value,
      genre: genre.value,
      rating: rating.value
  })
  .then(() => {
      alert("Data stored");
  })
  .catch((error) => {
      alert("Not stored"+error);
  });
}
//---------------------------------Uhhhh--------------------------------//


window.onload = gimmeRealTime
btncreate.addEventListener('click', insertData)

//---------------------------------Uhhhh--------------------------------//
