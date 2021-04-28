window.addEventListener("load", () => {

  const loginButton = document.querySelector("#login");
  const logoutButton = document.querySelector("#logout");

  const addButton = document.querySelector("#item_btn");
  const resetButton = document.querySelector("#reset_btn");

  const loginDiv = document.querySelector("#user_login");
  const shoppingDiv = document.querySelector("#shopping")

  const itemsList = document.getElementById("shopping_list");

  let userNameGlobal = window.sessionStorage.getItem("userName");
  let tableRows = [];

  const updateItems = () => {
    const items = JSON.parse(window.localStorage.getItem("items"));
    while(itemsList.rows.length > 1){
      itemsList.deleteRow(-1);
    }
    if(items !== null && items !== undefined){
      userItems = items.find(e => e.userName.trim() === userNameGlobal.trim()).items;
      for(let i = 0; i< userItems.length; i++){
        const newRow = itemsList.insertRow(itemsList.rows.length);
        const cellID = newRow.insertCell(0);
        const cellName = newRow.insertCell(1);
        const cellQty = newRow.insertCell(2);

        cellID.innerHTML = (i + 1) + ".";
        cellName.innerHTML = userItems[i].productName;
        cellQty.innerHTML = userItems[i].productQty;
        newRow.addEventListener("click", (event) => {
          event.preventDefault();
          const itemName = event.target.innerHTML;
          if(confirm("Are you sure you want to delete " + itemName + "?")){
            const items = JSON.parse(window.localStorage.getItem("items"));
          const newItems = items
            .map(e => (e.userName.trim() === userNameGlobal.trim()) 
            ?
            {
              userName: e.userName,
              items: e.items.filter(each => each.productName.trim() !== itemName.trim())
            }
            :
            e
            );
          console.log(items);
          console.log(newItems);
          window.localStorage.setItem("items", JSON.stringify(newItems));
          updateItems();
          }
        });

        tableRows.push(newRow);
      }
    }
  }

  if(userNameGlobal !== null){
    loginDiv.classList.add("hidden");
    document.getElementById("shopping_header").innerHTML = userNameGlobal + "'s Shopping List";
    updateItems();
  }else{
    shoppingDiv.classList.add("hidden");
  }

  loginButton.addEventListener("click", (event) => {
    event.preventDefault();
    const nameField = document.getElementById("username");
    const userName = nameField.value.trim();
    if(userName === ""){
      alert("Invalid username!");
      nameField.value = "";
    }else{
      userNameGlobal = userName;
      nameField.value = "";
      document.cookie = "userName=" + userName;
      window.sessionStorage.setItem("userName", userName);
      loginDiv.classList.add("hidden");
      shoppingDiv.classList.remove("hidden");
      document.getElementById("shopping_header").innerHTML = userName + "'s Shopping List";
      updateItems();
    }
  });

  logoutButton.addEventListener("click", () => {
    document.cookie = "userName=";
    window.sessionStorage.removeItem("userName");
    userNameGlobal = "";
    loginDiv.classList.remove("hidden");
    shoppingDiv.classList.add("hidden");
  });

  resetButton.addEventListener("click", (event) => {
    event.preventDefault();
    window.localStorage.removeItem("items");
    updateItems();
  })

  addButton.addEventListener("click", (event) => {
    event.preventDefault();
    const itemName = document.getElementById("product");
    const itemQty = document.getElementById("qty");
    productName = itemName.value.trim();
    if(productName === ""){
      alert("Invalid Item name!");
      itemName.value = "";
    }else{
      productQty = itemQty.value;
      itemName.value = "";
      itemQty.value = "";
      let items = JSON.parse(window.localStorage.getItem("items"));
      const userName = window.sessionStorage.getItem("userName");
      if(items === null){
        items = [
          {
            userName: userName,
            items: [
              {
                productName: productName.trim(),
                productQty: productQty
              }
            ]
          }
        ];
      }else if(items.find(e => e.userName === userName) === null || items.find(e => e.userName === userName) === undefined){
        items.push({
          userName: userName,
          items: [
            {
              productName: productName.trim(),
              productQty: productQty
            }
          ]
        });
      }else {
        const userEntry = items.find(e => e.userName === userName);
        const itemEntry = userEntry.items.find(e => e.productName === productName);
        if(itemEntry === null || itemEntry === undefined){
          userEntry.items.push({
              productName: productName.trim(),
              productQty: productQty
          });
        }else{
          itemEntry.productQty =  parseInt(productQty) + parseInt(itemEntry.productQty);
        }
      }
      window.localStorage.setItem("items", JSON.stringify(items));
      updateItems();
    }
  });
});
