using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using UnityEngine;

namespace Assets {
    interface IEnemyState {
        IEnemyState Update(Transform playerObj);
        void DoAction(Transform playerObj);
    }
}
