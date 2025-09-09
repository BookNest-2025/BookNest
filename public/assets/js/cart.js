 
    function changeQuantity(button, change) {
      let row = button.closest("tr");
      let input = row.querySelector("input");
      let price = parseFloat(row.dataset.price);

      let qty = parseInt(input.value);
      qty = Math.max(1, qty + change);
      input.value = qty;

      updateCartTotal();
    }

    function removeItem(button) {
      let row = button.closest("tr");
      row.remove();
      updateCartTotal();
    }

    function updateCartTotal() {
      let rows = document.querySelectorAll("tbody tr");
      let total = 0;
      rows.forEach(row => {
        let price = parseFloat(row.dataset.price);
        let qty = parseInt(row.querySelector("input").value);
        total += price * qty;
      });
      document.getElementById("cart-total").textContent = "$" + total.toFixed(2);
    }
