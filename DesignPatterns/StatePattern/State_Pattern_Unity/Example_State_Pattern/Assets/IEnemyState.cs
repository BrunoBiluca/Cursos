using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using UnityEngine;

namespace Assets {
    public interface IEnemyState {
        IEnemyState Handle(Enemy enemy, Transform playerObj);
        void Update(Enemy enemy, Transform playerObj);
    }
}
