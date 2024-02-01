import React, { useState, useEffect } from 'react';
import reactLogo from './assets/react.svg';
import viteLogo from '/vite.svg';
import './App.css';

function App() {
  const [data, setData] = useState([]);

  useEffect(() => {
    // Fetch data from your PHP backend
    fetch('connect.php')  // หรือเปลี่ยนเป็น URL ที่เชื่อมต่อกับตาราง users
      .then((response) => response.json())
      .then((result) => setData(result))
      .catch((error) => console.error('Error fetching data:', error));
  }, []);


  return (
    <>
      <div className="overflow-x-auto">
        <table className="table table-xs table-pin-rows table-pin-cols">
          <thead>
            <tr>
              <th>PID</th>
              <th>ชื่อ</th>
              <th>นามสกุล</th>
              <th>ชื่อ face</th>
              <th>เลขบัตร</th>
              <th>สถานะ</th>
              <th>ปุ่ม</th>
            </tr>
          </thead>
          <tbody>
            {data.map((row) => (
              <tr key={row.uid}>
                {/* Populate table cells with data from the API response */}
                <td>{row.pid}</td>
                <td>{row.fname}</td>
                <td>{row.lname}</td>
                <td>{row.facename}</td>
                <td>{row.cardid}</td>
                <td>{row.status}</td>
                <td> {/* You can add buttons or any other elements here */}</td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
    </>
  );
}

export default App;
