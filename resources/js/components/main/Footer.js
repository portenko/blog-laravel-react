import { Container, Row, Col } from 'bootstrap-4-react';
import './Footer.scss';
import React, { Component } from 'react';

import svgFb from './img/social/fb.svg';
import svgIg from './img/social/ig.svg';
import svgTw from './img/social/tw.svg';
import svgLi from './img/social/li.svg';

class Footer extends Component {
    render(){
        return (
          <>
              <footer>
                  <Container>
                      <div className="social">
                          <a href="https://facebook.com/" className="fb">
                              <img src={svgFb} alt="Facebook"/>
                          </a>
                          <a href="https://www.instagram.com/" className="ig">
                              <img src={svgIg} alt="Instagram"/>
                          </a>
                          <a href="https://twitter.com/" className="tw">
                              <img src={svgTw} alt="Twitter"/>
                          </a>
                          <a href="https://www.linkedin.com/" className="li">
                              <img src={svgLi} alt="LinkedIn"/>
                          </a>
                      </div>
                      <div className="copyright">
                          Copyright ©{(new Date().getFullYear())} All rights reserved
                      </div>
                  </Container>
              </footer>
          </>
        );
    }
}
export default Footer;
