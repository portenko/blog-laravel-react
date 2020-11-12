import { Container } from 'bootstrap-4-react';
import './Navbar.scss';
import React, { Component } from 'react';
import {Link} from "react-router-dom";

class Navbar extends Component {
    render(){
        return (
          <>
              <nav className="navbar">
                  <Container>
                      <Link to="/" className="navbar-brand">
                            Home
                      </Link>
                      <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                              aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                          <span className="navbar-toggler-icon"></span>
                      </button>
                  </Container>
              </nav>
          </>
        );
    }
}
export default Navbar;
